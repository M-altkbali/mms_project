<?php

namespace App\Http\Controllers;

use App\Models\Wahadat;
use App\Models\UnitBranch;
use Illuminate\Http\Request;
use App\Models\employeesOfficer;

class EmployeeOfficerController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:empOffice-all|empOffice-list|empOffice-create|empOffice-update|empOffice-delete|empOffice-show', ['only' => ['index', 'store']]);
        $this->middleware('permission:empOffice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:empOffice-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:empOffice-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        if (request('search')) {
            $employeesOfficer['employeesOfficer'] = employeesOfficer::where('national_no', 'like', '%' . request('search') . '%')->get();
            // $employees::orderBy('id')->paginate(20);
        } else {
            $employeesOfficer['employeesOfficer'] = employeesOfficer::orderBy('id')->paginate(20);
        }
        
        return view('employees_officer.index', $employeesOfficer);
    }


    public function create()
    {
        $wahadat = UnitBranch::all();
        return view('employees_officer.create', compact('wahadat'));
    }


    public function store(Request $request)
    {

        #region Save Employee Data

        $employees = new employeesOfficer();

        $employees->full_name = $request->full_name;
        $employees->national_no = $request->national_no;
        // $employees->financial_Figure = $request->financial_Figure;
        $employees->birth_d = $request->birth_d;
        $employees->place_birth = $request->place_birth;
        $employees->place_residence = $request->place_residence;
        $employees->closest_point = $request->closest_point;
        $employees->nationality = $request->nationality;
        $employees->religion = $request->religion;
        $employees->blood_t = $request->blood_t;
        $employees->phone_n = $request->phone_n;
        $employees->marital_status = $request->marital_status;
        $employees->sons = $request->sons;
        $employees->daughter = $request->daughter;
        $employees->closest_relatives = $request->closest_relatives;
        $employees->closest_relatives_Phone = $request->closest_relatives_Phone;
        $employees->passport_or_card = $request->passport_or_card;
        $employees->passport = $request->passport;
        $employees->passport_releaseDate = $request->passport_releaseDate;
        $employees->passport_placeOfissue = $request->passport_placeOfissue;
        $employees->id_card = $request->id_card;
        $employees->id_card_releaseDate = $request->id_card_releaseDate;
        $employees->id_card_placeOfissue = $request->id_card_placeOfissue;
        $employees->familyHandbook_No = $request->familyHandbook_No;
        $employees->familyRegistration_No = $request->familyRegistration_No;
        $employees->familyPaper_No = $request->familyPaper_No;
        $employees->familyHandbook_No___releaseDate = $request->familyHandbook_No___releaseDate;
        $employees->familyHandbook_No___placeOfissue = $request->familyHandbook_No___placeOfissue;
        // $employees->adjective = $request->adjective;
        $employees->military_number = $request->military_number;
        $employees->Rank = $request->Rank;
        $employees->bankName_id = $request->bankName_id;
        $employees->bankBranch_id = $request->bankBranch_id;
        $employees->bank_accountNo = $request->bank_accountNo;
        $employees->unitName = $request->unitName;
        $employees->unitBranch_id = $request->unitBranch_id;
        $employees->classificationEmpContract = $request->classificationEmpContract;
        $employees->hiringDate = $request->hiringDate;
        $employees->startJopDate = $request->startJopDate;
        $employees->appointment_decision = $request->appointment_decision;
        $employees->Contract_registrationNo = $request->Contract_registrationNo;
        $employees->lastPromotion = $request->lastPromotion;
        $employees->current_grade = $request->current_grade;
        $employees->current_grade_date = $request->current_grade_date;
        $employees->courses_obtained = $request->courses_obtained;
        $employees->diseases = $request->diseases;
        $employees->notes = $request->notes;
        $employees->vacations = $request->vacations;
        $employees->medical_comfort = $request->medical_comfort;
        $employees->altasweat = $request->altasweat;
        $employees->placement = $request->placement;
        $employees->graduationDate = $request->graduationDate;
        $employees->qualification = $request->qualification;
        $employees->specialization = $request->specialization;
        $employees->graduationPlace = $request->graduationPlace;
        $employees->workplace = $request->workplace;

        #endregion

        if (($employees->national_no) == null && ($employees->bank_accountNo) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name',
                    'military_number' => 'required|unique:employees_officers,military_number',
                    // 'national_no' => 'unique:employees_officers,national_no',
                    // 'bank_accountNo' => 'unique:employees_officers'

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    // 'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    // 'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->save();


            return redirect()->route('employeesofficer.index')->with('success', 'تم حفظ الضابط بنجاح');
        }
        if (($employees->bank_accountNo) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name',
                    'military_number' => 'required|unique:employees_officers,military_number',
                    'national_no' => 'unique:employees_officers,national_no',
                    // 'bank_accountNo' => 'unique:employees_officers'

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    // 'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->save();


            return redirect()->route('employeesofficer.index')->with('success', 'تم حفظ الضابط بنجاح');
        }
        if (($employees->national_no) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name',
                    'military_number' => 'required|unique:employees_officers,military_number',
                    // 'national_no' => 'unique:employees_officers,national_no',
                    'bank_accountNo' => 'unique:employees_officers'

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    // 'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->save();


            return redirect()->route('employeesofficer.index')->with('success', 'تم حفظ الضابط بنجاح');
        } else {
            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name',
                    'military_number' => 'required|unique:employees_officers,military_number',
                    'national_no' => 'unique:employees_officers,national_no',
                    'bank_accountNo' => 'unique:employees_officers'

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->save();


            return redirect()->route('employeesofficer.index')->with('success', 'تم حفظ الضابط بنجاح');
        }

        $employees->save();


        return redirect()->route('employeesofficer.index')->with('success', 'تم حفظ الضابط بنجاح');
    }


    public function show()
    {
        // return view('employees.show');
    }


    public function edit($id)
    {
        // return $id;
        $employeeOfficers = employeesOfficer::find($id);



        if ($employeeOfficers) {
            // return  $employees; 
            return view('employees_officer.edit', compact('employeeOfficers'));
        } else {
            return response('Employee not found ..!');
        }
        // return view('employees.edit');
    }


    public function update(Request $request, $id)
    {

        #region Update Employee Data

        $employees = employeesOfficer::find($id);

        $employees->full_name = $request->full_name;
        $employees->national_no = $request->national_no;
        // $employees->financial_Figure = $request->financial_Figure;
        $employees->birth_d = $request->birth_d;
        $employees->place_birth = $request->place_birth;
        $employees->place_residence = $request->place_residence;
        $employees->closest_point = $request->closest_point;
        $employees->nationality = $request->nationality;
        $employees->religion = $request->religion;
        $employees->blood_t = $request->blood_t;
        $employees->phone_n = $request->phone_n;
        $employees->marital_status = $request->marital_status;
        $employees->sons = $request->sons;
        $employees->daughter = $request->daughter;
        $employees->closest_relatives = $request->closest_relatives;
        $employees->closest_relatives_Phone = $request->closest_relatives_Phone;
        $employees->passport_or_card = $request->passport_or_card;
        $employees->passport = $request->passport;
        $employees->passport_releaseDate = $request->passport_releaseDate;
        $employees->passport_placeOfissue = $request->passport_placeOfissue;
        $employees->id_card = $request->id_card;
        $employees->id_card_releaseDate = $request->id_card_releaseDate;
        $employees->id_card_placeOfissue = $request->id_card_placeOfissue;
        $employees->familyHandbook_No = $request->familyHandbook_No;
        $employees->familyRegistration_No = $request->familyRegistration_No;
        $employees->familyPaper_No = $request->familyPaper_No;
        $employees->familyHandbook_No___releaseDate = $request->familyHandbook_No___releaseDate;
        $employees->familyHandbook_No___placeOfissue = $request->familyHandbook_No___placeOfissue;
        // $employees->adjective = $request->adjective;
        $employees->military_number = $request->military_number;
        $employees->Rank = $request->Rank;
        $employees->bankName_id = $request->bankName_id;
        $employees->bankBranch_id = $request->bankBranch_id;
        $employees->bank_accountNo = $request->bank_accountNo;
        $employees->unitName = $request->unitName;
        $employees->unitBranch_id = $request->unitBranch_id;
        $employees->classificationEmpContract = $request->classificationEmpContract;
        $employees->hiringDate = $request->hiringDate;
        $employees->startJopDate = $request->startJopDate;
        $employees->appointment_decision = $request->appointment_decision;
        $employees->Contract_registrationNo = $request->Contract_registrationNo;
        $employees->lastPromotion = $request->lastPromotion;
        $employees->current_grade = $request->current_grade;
        $employees->current_grade_date = $request->current_grade_date;
        $employees->courses_obtained = $request->courses_obtained;
        $employees->diseases = $request->diseases;
        $employees->notes = $request->notes;
        $employees->vacations = $request->vacations;
        $employees->medical_comfort = $request->medical_comfort;
        $employees->altasweat = $request->altasweat;
        $employees->placement = $request->placement;
        $employees->graduationDate = $request->graduationDate;
        $employees->qualification = $request->qualification;
        $employees->specialization = $request->specialization;
        $employees->graduationPlace = $request->graduationPlace;
        $employees->workplace = $request->workplace;

        #endregion

        if (($employees->national_no) == null && ($employees->bank_accountNo) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name,' . $id . '',
                    'military_number' => 'required|unique:employees_officers,military_number,' . $id . '',
                    // 'national_no' => 'unique:employees_officers,national_no|max:12',
                    // 'bank_accountNo' => 'unique:employees_officers'
                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    // 'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'national_no.max' => 'الحد الأقصى للادخال 12 رقم'
                    // 'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->update();


            return redirect()->route('employeesofficer.index')->with('success', 'تم تعديل بيانات الضابط بنجاح');
        }
        if (($employees->bank_accountNo) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name,' . $id . '',
                    'military_number' => 'required|unique:employees_officers,military_number,' . $id . '',
                    'national_no' => 'unique:employees_officers,national_no,' . $id . '|max:12',
                    // 'bank_accountNo' => 'unique:employees_officers'

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'national_no.max' => 'الحد الأقصى للادخال 12 رقم'
                    // 'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->update();


            return redirect()->route('employeesofficer.index')->with('success', 'تم تعديل بيانات الضابط بنجاح');
        }
        if (($employees->national_no) == null) {

            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name,' . $id . '',
                    'military_number' => 'required|unique:employees_officers,military_number,' . $id . '',
                    // 'national_no' => 'unique:employees_officers,national_no|max:12',
                    'bank_accountNo' => 'unique:employees_officers,bank_accountNo,' . $id . ''

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    'national_no.max' => 'الحد الأقصى للادخال 12 رقم',
                    // 'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->update();


            return redirect()->route('employeesofficer.index')->with('success', 'تم تعديل بيانات الضابط بنجاح');
        } else {
            $request->validate(
                [
                    'full_name' => 'required|unique:employees_officers,full_name,' . $id . '',
                    'military_number' => 'required|unique:employees_officers,military_number,' . $id . '',
                    'national_no' => 'unique:employees_officers,national_no,' . $id . '|max:12',
                    'bank_accountNo' => 'unique:employees_officers,bank_accountNo,' . $id . ''

                ],
                [
                    'military_number.required' => 'الرجاء ادخال الرقم العسكري',
                    'military_number.unique' => 'الرقم العسكري موجود مسبقاً ',
                    'full_name.required' => 'الرجاء ادخال اسم الضابط ',
                    'full_name.unique' => 'اسم الضابط موجود مسبقا',
                    'national_no.unique' => 'الرقم الوطني الذي ادخلته موجود مسبقاً',
                    'national_no.max' => 'الحد الأقصى للادخال 12 رقم',
                    'bank_accountNo.unique' => 'رقم الحساب الذي ادخلته موجود مسبقاً',
                ]
            );

            $employees->update();
            return redirect()->route('employeesofficer.index')->with('success', 'تم تعديل بيانات الضابط بنجاح');
        }

        $employees->update();
        return redirect()->route('employeesofficer.index')->with('success', 'تم تعديل بيانات الضابط بنجاح');
    }


    public function destroy($id)
    {
        $employee = employeesOfficer::findOrFail($id);
        $employee->delete();
        return back();
        // return redirect()->route('employeesofficer.index')->with('success', 'تم حذف الضابط بنجاح');
    }
}