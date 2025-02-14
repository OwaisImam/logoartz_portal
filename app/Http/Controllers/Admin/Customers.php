<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Illuminate\Http\Request;

class Customers extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $length = $request->get("length");
            $search = $request->get('search')['value'];

            $query = Customers::query();

            // Search logic
            if (!empty($search)) {
                $query->where('name', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%');
            }

            // Total records
            $total = $query->count();

            // Pagination
            $data = $query->offset($start)
                          ->limit($length)
                          ->get();

            return response()->json([
                'draw' => $draw,
                'recordsTotal' => Customers::count(),
                'recordsFiltered' => $total,
                'data' => $data
            ]);
        }

        $this->data['recordsTotal'] = \App\Customers::count();

        return view('admin.customers.index', $this->data);
    }

    public function customers_list()
    {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);
        $HearAbout = Config('hear_about');

        $columns = ["", "CustomerID", "CustomerName", "Cell", "Email", "Status", "CustomerArrive", "DateAdded","DateModified"];

        $query = \App\Customers::select(['CustomerID', 'CustomerName', 'Cell', 'Email',
                    DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"), 'HearAbout',
                    DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
                    DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")]);

        $recordsTotal = count($query->get());


        if (!empty(Input::get('search')["value"])) {
            $input = strtolower(trim(Input::get('search')["value"]));
            $query->whereRaw("(CustomerName LIKE '%" . $input . "%' OR Cell LIKE '%" . $input . "%' OR Email LIKE '%" . $input . "%')");
        }

        $query->orderBy($columns[(int) Input::get('order')[0]["column"]], strtoupper(Input::get('order')[0]["dir"]));
        $query->orderBy("CustomerID", "DESC");

        // limit acc to start and length
        $recordsFiltered = count($query->get());
        $result = $query->skip($start)->take($length)->get();
        // $maxRow = count($result);
        $data = [];
        foreach ($result as $Rs) {
            $path = url('admin/customers/sortdetails').'/' . $Rs->CustomerID;
            $fullPath = '<a href="'.$path.'"> '.$Rs->CustomerName.'</a>';

            $data[] = [
                "<input type=\"checkbox\" class=\"check\" name=\"ids[]\" value=\"" . $Rs->CustomerID . "\" />",
                $Rs->CustomerID,
                $fullPath,
                $Rs->Cell,
                $Rs->Email,
                $Rs->Status,
                $HearAbout[$Rs->HearAbout],
                $Rs->DateAdded,
                '<button type="button" class="btn btn-success btn-sm" onClick="location.href=\'customers/' . $Rs->CustomerID . '\'"><i class="fa fa-edit"></i> Edit</button><br><button type="button" class="btn btn-success btn-sm" onClick="location.href=\'CusStomers/yhydgsysdywikyhkkwsdsdjiasdun/' . $Rs->CustomerID . '\'"><i class="fa fa-edit"></i>SignIn</button>'
            ];
        }


        echo json_encode(["draw" => (int) Input::get('draw'), "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, "data" => $data]);
        exit(0);
    }

    public function countries_dd()
    {
        $query = \App\Countries::where('Status', 1);
        $parents = $query->select('CountryName', 'CountryID')->get();
        $parent_pages = ["0" => "Select Country"];
        if (count($parents) > 0) {
            foreach ($parents as $parent) {
                $parent_pages += [
                    $parent->CountryID => $parent->CountryName
                ];
            }
        }
        return $parent_pages;
    }

    public function add()
    {
        $this->data['countries_dd'] = $this->countries_dd();
        //$this->data['salesperson'] = \App\SalesPerson::select('SalesPersonID', 'SalesPersonName')->get();

        $this->data['salesperson'] = \App\SalesPerson::pluck('SalesPersonName', 'SalesPersonID');

        return view('admin.customers.add', $this->data);
    }

    public function save()
    {

        $error = false;
        $msg = "";

        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];

        if (Input::hasFile('Image')) {
            $fl = Input::file('Image');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error = true;
                    $msg = "Invalid Image type";
                }
            }
        }


        // $GetSale = \Input::all();

        // dd($GetSale);



        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'max:20';
        $valid["Email"] = 'required|email|max:50|unique:customers';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'max:100';
        $valid["State"] = 'max:100';
        $valid["City"] = 'max:100';
        $valid["Address"] = 'max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100|unique:customers';
        $valid["Password"] = 'required|max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["CustomerName"] = "Customer Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Company"] = "Company";
        $valid_name["State"] = "State";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
        $valid_name["Password"] = "Password";
        $valid_name["Status"] = "Status";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails() || $error) {
            if ($error) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg);
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {
            $cat = new \App\Customers();

            $cat->CustomerName = Input::get('CustomerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            $cat->Password = \Hash::make(Input::get('Password'));
            $cat->IsActivated = 1;
            if (!empty(Input::get('SalesPerson'))) {
                $cat->SalesPersonID = Input::get('SalesPerson');
            }
            if (!empty(Input::get('FreeOrder'))) {
                $cat->FreeOrderPlaced = Input::get('FreeOrder');
            }
            $cat->priceplane = Input::get('Pplane');
            $cat->CsNote = Input::get('CsNote');
            $cat->ActivationCode = "";
            $cat->IsActivated = 1;
            $cat->Status = Input::get('Status');
            $cat->DateAdded = new \DateTime();

            $cat->save();

            $CustomerID = \DB::getPdo()->lastInsertId();

            if (Input::hasFile('Image')) {
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $filename = $CustomerID . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/customers/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('customers')->where('CustomerID', $CustomerID)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/customers')->with(['success' => "Customer Added Successfully"]);
        }
    }

    public function edit($id)
    {
        $query = \DB::table('customers');
        $query->where('CustomerID', $id);

        $this->data['cust'] = $query->first();
        $this->data['salesperson'] = \App\SalesPerson::pluck('SalesPersonName', 'SalesPersonID');

        if (empty($this->data['cust'])) {
            return redirect('admin/customers')->with('warning_msg', "Invalid Customer ID");
        } else {
            $this->data['countries_dd'] = $this->countries_dd();
            return view('admin.customers.edit', $this->data);
        }
    }

    public function update($id)
    {

        $error = false;
        $msg = "";

        $allowed_ext = ['jpg', 'JPG', 'JPEG', 'jpeg', 'png', "PNG", 'gif', 'GIF'];

        if (Input::hasFile('Image')) {
            $fl = Input::file('Image');
            if (!empty($fl)) {
                $ext = $fl->getClientOriginalExtension();
                if (!in_array($ext, $allowed_ext)) {
                    $error = true;
                    $msg = "Invalid Image type";
                }
            }
        }

        $valid["CountryID"] = 'required|integer|min:1';
        $valid["CustomerName"] = 'required|max:20';
        $valid["Cell"] = 'max:20';
        $valid["Email"] = 'email|max:50';
        $valid["Fax"] = 'max:100';
        $valid["Company"] = 'max:100';
        $valid["State"] = 'max:100';
        $valid["City"] = 'max:100';
        $valid["Address"] = 'max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100';
        $valid["Password"] = 'max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["CustomerName"] = "Customer Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Company"] = "Company";
        $valid_name["State"] = "State";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
        $valid_name["Password"] = "Password";
        $valid_name["Status"] = "Status";

        $messages = [
            'required' => 'Please enter :attribute.',
            'CountryID.min' => 'Please select :attribute.',
            'max' => 'No more characters allowed in :attribute.'
        ];

        $v = Validator::make(\Input::all(), $valid, $messages);
        $v->setAttributeNames($valid_name);
        if ($v->fails()) {
            if ($error) {
                return redirect()->back()->withErrors($v->errors())->withInput()->with('warning_msg', $msg);
            } else {
                return redirect()->back()->withErrors($v->errors())->withInput();
            }
        } else {

            // dd(Input::get('CsNote'));

            $cat = \App\Customers::find($id);

            $cat->CustomerName = Input::get('CustomerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Company = Input::get('Company');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            if (Input::has('Password') && Input::get('Password') != "") {
                $cat->Password = \Hash::make(Input::get('Password'));
            }
            if (!empty(Input::get('SalesPerson'))) {
                $cat->SalesPersonID = Input::get('SalesPerson');
            }
            $cat->priceplane = Input::get('Pplane');
            $cat->CsNote = Input::get('CsNote');
            $cat->Status = Input::get('Status');
            $cat->DateModified = new \DateTime();

            $cat->save();

            if (Input::hasFile('Image')) {
                $i = 1;
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $prod = DB::table('customers')->select('DP')->where('CustomerID', $id)->first();
                    if (\File::exists(public_path('uploads') . '/customers/' . $prod->DP)) {
                        \File::delete(public_path('uploads') . '/customers/' . $prod->DP);
                    }
                    $filename = $id . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/customers/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('customers')->where('CustomerID', $id)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/customers')->with(['success' => "Customer Updated Successfully"]);
        }
    }

    public function CustomerAthenR($CustomerID)
    {

        if (!empty($CustomerID)) {
            return redirect()->to('admin/sjdnasjclientaskdn/LdedeeGj8kIsdasN/'.$CustomerID);
        } else {

            return redirect('admin/customers')->with('warning_msg', "System Error!! Contect Technical Team");
        }



    }

    public function w_dujbjm_client($CustomerID)
    {
        if (\Session::has('CustomerLogin')) {
            return redirect()->back()->withErrors("One Customer Login Only");
        } else {

            $user = DB::table('customers')
                  ->where('CustomerID', $CustomerID)
                  ->where('Status', 1)
                  ->first();
        }


        if (!empty($user)) {
            \Session::put('CustomerLogin', true);
            \Session::put("CustomerID", $user->CustomerID);
            \Session::put("SalesPersonID", $user->SalesPersonID);
            \Session::put('CustomerName', $user->CustomerName);
            \Session::put('Cell', $user->Cell);
            \Session::put('Email', $user->Email);
            return redirect('/CustomerDash');

        } else {
            return redirect()->back()->withErrors("Unknown Error, Error# 75893-4");

        }



    }


    public function delete()
    {
        if (count(\Input::get('ids')) > 0) {
            DB::table('customers')
                    ->whereIn('CustomerID', \Input::get('ids'))
                    ->delete();
        }
        return redirect('admin/customers')->with('success', "Selected Customer Deleted Successfully");
    }

}
