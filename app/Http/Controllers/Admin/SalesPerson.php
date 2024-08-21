<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;

class SalesPerson extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

         $this->data['recordsTotal'] = \App\SalesPerson::count();
         return view('admin.salesperson.index', $this->data);
    }

   
    public function salesperson_list() {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);

        $columns = ["", "SalesPersonID", "SalesPersonName", "Cell", "Email", "AmountPayable", "AmountPaid", "Status", "DateAdded", "DateModified"];

        $query = \App\SalesPerson::select(['SalesPersonID', 'SalesPersonName', 'Cell', 'Email', "AmountPayable", "AmountPaid", 
                    DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"),
                    DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
                    DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")]);

        $recordsTotal = count($query->get());

        if (!empty(Input::get('search')["value"])) {
            $input = strtolower(trim(Input::get('search')["value"]));
            $query->whereRaw("(SalesPersonName LIKE '%" . $input . "%' OR Cell LIKE '%" . $input . "%' OR Email LIKE '%" . $input . "%')");
        }

        $query->orderBy($columns[(int) Input::get('order')[0]["column"]], strtoupper(Input::get('order')[0]["dir"]));
        $query->orderBy("SalesPersonID", "DESC");

        // limit acc to start and length
        $recordsFiltered = count($query->get());
        $result = $query->skip($start)->take($length)->get();
        // $maxRow = count($result);
        $data = [];
        foreach ($result as $Rs) {
            $data[] = [
                "<input type=\"checkbox\" class=\"check\" name=\"ids[]\" value=\"" . $Rs->SalesPersonID . "\" />",
                $Rs->SalesPersonID,
                $Rs->SalesPersonName,
                $Rs->Cell,
                $Rs->Email,
                $Rs->AmountPayable,
                $Rs->AmountPaid,
                $Rs->Status,
                $Rs->DateAdded,
                $Rs->DateModified,
                '<button type="button" class="btn btn-success btn-sm" onClick="location.href=\'salesperson/' . $Rs->SalesPersonID . '\'"><i class="fa fa-edit"></i> Edit</button>'
            ];
        }


        echo json_encode(["draw" => (int) Input::get('draw'), "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, "data" => $data]);
        exit(0);
    }
   

    public function countries_dd() {
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

    public function getVehicle() {
        $Vehicle = DB::table('vehicles')->where('VehicleID', Input::get('VehicleID'))->first();
        echo json_encode(['BrandName' => $Vehicle->Brand, 'Driver' => $Vehicle->Driver]); die;
    }

    public function add() {
        $this->data['countries_dd'] = $this->countries_dd();
        $this->data['vehicles'] = DB::table('vehicles')->pluck('VehicleNo', 'VehicleID')->toArray();
        // echo '<pre>'.print_r($this->data['vehicles']).'</pre>'; die;
        return view('admin.salesperson.add', $this->data);
    }

    public function save() {

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
        $valid["SalesPersonName"] = 'required|max:20';
        $valid["Cell"] = 'required|max:20';
        $valid["Email"] = 'required|email|max:50';
        $valid["Category"] = 'max:9';
        $valid["State"] = "required";
        $valid["Fax"] = 'max:100';
        $valid["Zip"] = 'max:20';
        $valid["Address"] = "required";
        $valid["Username"] = 'required|max:100';
        $valid["Password"] = 'required|max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["SalesPersonName"] = "Sales Rep Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Category"] = "Sales Rep type";
        $valid_name["Fax"] = "Fax";
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
            $cat = new \App\SalesPerson;

            $cat->SalesPersonName = Input::get('SalesPersonName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Category = 1;
            $cat->Fax = Input::get('Fax');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            $cat->Password = \Hash::make(Input::get('Password'));
            $cat->IsActivated = 1;
            $cat->Status = Input::get('Status');
            $cat->DateAdded = new \DateTime;

            $cat->save();


      //      echo "Successfully"; die;

         
            $SalesPersonID = \DB::getPdo()->lastInsertId();


            if (Input::hasFile('Image')) {
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $filename = $SalesPersonID . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/salesperson/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('salesperson')->where('SalesPersonID', $SalesPersonID)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/salesperson')->with(['success' => "Sales Person Added Successfully"]);
        }
    }

    public function edit($id) {
        $query = \DB::table('salesperson');
        $query->where('SalesPersonID', $id);

        $this->data['design'] = $query->first();



        if (empty($this->data['design'])) {
            return redirect('admin/salesperson')->with('warning_msg', "Invalid Sales Person ID");
        } else {
            $this->data['countries_dd'] = $this->countries_dd();
            return view('admin.salesperson.edit', $this->data);
        }
    }

    public function update($id) {

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
        $valid["SalesPersonName"] = 'required|max:20';
        $valid["Cell"] = 'required|max:20';
        $valid["Email"] = 'required|email|max:50';
        $valid["Fax"] = 'max:100';
        $valid["State"] = 'required|max:100';
        $valid["City"] = 'required|max:100';
        $valid["Address"] = 'required|max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100';   
        $valid["Status"] = 'required|integer|min:0|max:1';



        $valid_name["CountryID"] = "Country";
        $valid_name["SalesPersonName"] = "Sales Person Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["State"] = "State";
        $valid_name["City"] = "City";
        $valid_name["Address"] = "Address";
        $valid_name["Zip"] = "Zip";
        $valid_name["Username"] = "Username";
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




            $cat = \App\SalesPerson::find($id);

            $cat->SalesPersonName = Input::get('SalesPersonName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->CountryID = Input::get('CountryID');
            $cat->State = Input::get('State');
            $cat->City = Input::get('City');
            $cat->Address = Input::get('Address');
            $cat->Zip = Input::get('Zip');
            $cat->Username = Input::get('Username');
            if (Input::has('Password') && Input::get('Password') != "") {
                $cat->Password = \Hash::make(Input::get('Password'));
            }
            $cat->Status = Input::get('Status');
            $cat->DateModified = new \DateTime;

            $cat->save();




            if (Input::hasFile('Image')) {
                $i = 1;
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $prod = DB::table('salesperson')->select('DP')->where('SalesPersonID', $id)->first();
                    if (\File::exists(public_path('uploads') . '/salesperson/' . $prod->DP)) {
                        \File::delete(public_path('uploads') . '/salesperson/' . $prod->DP);
                    }
                    $filename = $id . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/salesperson/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('salesperson')->where('SalesPersonID', $id)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/salesperson')->with(['success' => "Sales Person Updated Successfully"]);
        }
    }

    public function delete() {
        if (count(\Input::get('ids')) > 0) {
            DB::table('salesperson')
                    ->whereIn('SalesPersonID', \Input::get('ids'))
                    ->delete();
        }
        return redirect('admin/salesperson')->with('success', "Selected Sales Man Deleted Successfully");
    }
    
    public function details($id) {
        $query = \DB::table('designers');
        $query->where('DesignerID', $id);

        $this->data['design'] = $query->first();



        if (empty($this->data['design'])) {
            return redirect('admin/designers')->with('warning_msg', "Invalid Customer ID");
        } else {
            $this->data['countries_dd'] = $this->countries_dd();
            return view('admin.designers.details', $this->data);
        }
    }

}
