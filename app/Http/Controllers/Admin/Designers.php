<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use Validator;
use DB;
use Symfony\Component\VarDumper\Cloner\Data;

class Designers extends AdminController {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->data['recordsTotal'] = \App\Designers::count();
        return view('admin.designers.index', $this->data);
    }

    public function designers_list() {
        $start = (Input::has('start') ? (int) Input::get('start') : 0);
        $length = (Input::has('length') ? (int) Input::get('length') : 25);

        $columns = ["", "DesignerID", "DesignerName", "Cell", "Email", "AmountPayable", "AmountPaid", "Status", "DateAdded", "DateModified"];

        $query = \App\Designers::select(['DesignerID', 'DesignerName', 'Cell', 'Email', "AmountPayable", "AmountPaid", 
                    DB::raw("CONCAT('<small class=\"label bg-', IF(Status = 0, 'red', 'green'), '\" ><i class=\"fa ', IF(Status = 0, 'fa-times', 'fa-check'), '\"></i> ', IF(Status = 1, 'Active', 'Deactive'), '</small>') AS Status"),
                    DB::raw("DATE_FORMAT(DateAdded, \"%d-%b-%Y<br>%r\") as DateAdded"),
                    DB::raw("DATE_FORMAT(DateModified, \"%d-%b-%Y<br>%r\") as DateModified")]);

        $recordsTotal = count($query->get());

        if (!empty(Input::get('search')["value"])) {
            $input = strtolower(trim(Input::get('search')["value"]));
            $query->whereRaw("(DesignerName LIKE '%" . $input . "%' OR Cell LIKE '%" . $input . "%' OR Email LIKE '%" . $input . "%')");
        }

        $query->orderBy($columns[(int) Input::get('order')[0]["column"]], strtoupper(Input::get('order')[0]["dir"]));
        $query->orderBy("DesignerID", "DESC");

        // limit acc to start and length
        $recordsFiltered = count($query->get());
        $result = $query->skip($start)->take($length)->get();
        // $maxRow = count($result);
        $data = [];
        foreach ($result as $Rs) {
            $data[] = [
                "<input type=\"checkbox\" class=\"check\" name=\"ids[]\" value=\"" . $Rs->DesignerID . "\" />",
                $Rs->DesignerID,
                $Rs->DesignerName,
                $Rs->Cell,
                $Rs->Email,
                $Rs->AmountPayable,
                $Rs->AmountPaid,
                $Rs->Status,
                $Rs->DateAdded,
                $Rs->DateModified,
                '<button type="button" class="btn btn-success btn-sm" onClick="location.href=\'designers/' . $Rs->DesignerID . '\'"><i class="fa fa-edit"></i> Edit</button>'
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

    public function add() {
        $this->data['countries_dd'] = $this->countries_dd();
        return view('admin.designers.add', $this->data);
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
        $valid["DesignerName"] = 'required|max:20';
        $valid["Cell"] = 'required|max:20';
        $valid["Email"] = 'required|email|max:50|unique:designers';
        $valid["Fax"] = 'max:100';
        $valid["Category"] = 'required|integer|min:1|max:2';
        $valid["State"] = 'required|max:100';
        $valid["City"] = 'required|max:100';
        $valid["Address"] = 'required|max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100|unique:designers';
        $valid["Password"] = 'required|max:20';
        $valid["Status"] = 'required|integer|min:0|max:1';

        $valid_name["CountryID"] = "Country";
        $valid_name["DesignerName"] = "Desiner Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Category"] = "Category Like Vector or Digitizer";
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
            'max' => 'No more characters allowed in :attribute.',
            'unique' => ':attribute is already registered.'
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
            $cat = new \App\Designers;

            $cat->DesignerName = Input::get('DesignerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Category = Input::get('Category');
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


         
            $DesignerID = \DB::getPdo()->lastInsertId();


            if (Input::hasFile('Image')) {
                $fl = Input::file('Image');
                if (!empty($fl)) {
                    $filename = $DesignerID . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/designer/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('designers')->where('DesignerID', $DesignerID)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/designers')->with(['success' => "Designer Added Successfully"]);
        }
    }

    public function edit($id) {
        $query = \DB::table('designers');
        $query->where('DesignerID', $id);

        $this->data['design'] = $query->first();



        if (empty($this->data['design'])) {
            return redirect('admin/designers')->with('warning_msg', "Invalid Customer ID");
        } else {
            $this->data['countries_dd'] = $this->countries_dd();
            return view('admin.designers.edit', $this->data);
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
        $valid["DesignerName"] = 'required|max:20';
        $valid["Cell"] = 'required|max:20';
        $valid["Email"] = 'required|email|max:50';
        $valid["Fax"] = 'max:100';
        $valid["Category"] = 'required|integer|min:1|max:2';
        $valid["State"] = 'required|max:100';
        $valid["City"] = 'required|max:100';
        $valid["Address"] = 'required|max:1000';
        $valid["Zip"] = 'max:20';
        $valid["Username"] = 'required|max:100';   
        $valid["Status"] = 'required|integer|min:0|max:1';



        $valid_name["CountryID"] = "Country";
        $valid_name["DesignerName"] = "Desiner Name";
        $valid_name["Cell"] = "Cell";
        $valid_name["Email"] = "Email";
        $valid_name["Fax"] = "Fax";
        $valid_name["Category"] = "Category Like Vector or Digitizer";
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




            $cat = \App\Designers::find($id);

            $cat->DesignerName = Input::get('DesignerName');
            $cat->Cell = Input::get('Cell');
            $cat->Email = Input::get('Email');
            $cat->Fax = Input::get('Fax');
            $cat->Category = Input::get('Category');
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
                    $prod = DB::table('designers')->select('DP')->where('DesignerID', $id)->first();
                    if (\File::exists(public_path('uploads') . '/designers/' . $prod->DP)) {
                        \File::delete(public_path('uploads') . '/designers/' . $prod->DP);
                    }
                    $filename = $id . '_' . str_random(5) . '.' . $fl->getClientOriginalExtension();

                    $path = public_path('uploads') . '/designers/' . $filename;

                    \Image::make($fl->getRealPath())->save($path);
                    \DB::table('designers')->where('DesignerID', $id)->update(['DP' => $filename]);
                }
            }

            return redirect('admin/designers')->with(['success' => "Designer Updated Successfully"]);
        }
    }

    public function delete() {
        if (count(\Input::get('ids')) > 0) {
            DB::table('designers')
                    ->whereIn('DesignerID', \Input::get('ids'))
                    ->delete();
        }
        return redirect('admin/designers')->with('success', "Selected Designer Deleted Successfully");
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
