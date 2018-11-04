<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPayment;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Salary;
use Wolosky\Payment;
use Wolosky\Reference;
use Wolosky\Receipt;
use Wolosky\SaleDebt;
use Wolosky\RecordUserStatus;
use Wolosky\Record;
use Tymon\JWTAuth\Facades\JWTAuth;
use Image;
use File;


class UsersController extends Controller
{
    public function __construct(){ $this->middleware('adminCashier'); }

    public function get(Request $request)
    {
        $creator = JWTAuth::parseToken()->authenticate();

        if($creator->user_type_id >= 6){
            
            $users = User::where('name', 'LIKE', '%'. $request->searchWord .'%')
                        ->select('id', 'name', 'phone', 'gender', 'user_type_id', 'status')
                        ->orderBy('name', 'ASC')
                        ->paginate($request->items);

        } else if($creator->user_type_id == 3 || $creator->user_type_id == 4 ){

            $users =  User::where([
                            ['name', 'LIKE', '%'. $request->searchWord .'%'],
                            ['user_type_id', '=', 1],
                            ])
                            ->select('id', 'name', 'phone', 'gender', 'user_type_id', 'status')
                            
                            ->orderBy('name', 'ASC')
                            // ->groupBy('status')
                            ->paginate($request->items);
        }

        return response()->json($users);
        
    }

    public function showUser($id) {
        $user = User::where('id', $id)->with(['references', 'schedules', 'salary', 'monthly_payment'])->first();
        
        return response()->json($user);
    }

    public function searchUser(Request $request) {

    }

    public function createRecordStatus(){
        $user = User::all();
        for($x = 0; $x < count($user); $x++){
            $status = new RecordUserStatus();
            $status->user_id = $user[$x]->id;
            $status->creator_id = 3;
            $status->status = 1;
            $status->description = 'Usuario creado';
            $status->created_at = $user[$x]->created_at;
            $status->save();
        }

        return 'RECORDS CREATED';
    }

    public function create(Request $request) {
        
        $creator = JWTAuth::parseToken()->authenticate();
        
        $newUser = $request->user;        

        $user = new User();

        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->birthday = $newUser['birthday'];
        $user->gender = $newUser['gender'];
        $user->phone = $newUser['phone'];        
        $user->insurance = $newUser['insurance'];
        $user->curp = $newUser['curp'];
        $user->placeBirth = $newUser['placeBirth'];
        $user->street = $newUser['street'];
        $user->houseNumber = $newUser['houseNumber'];
        $user->colony = $newUser['colony'];
        $user->city = $newUser['city'];
        $user->user_type_id = $newUser['user_type_id'];
        $user->creator_user_id = $creator->id;

        if($newUser['password'] != NULL) 
            $user->password = bcrypt($newUser['password']);

        $user->save();

        if($user->user_type_id <= 4) {

            $this->createSchedule($request->schedules, $user->id);
            $this->createReferences($request->references, $user->id);

            if($user->user_type_id == 1)

                $user->monthly_payment_id = $this->createMonthlyPayment($request->monthlyPayment); 

            else {
                $user->salary_id = $this->createSalary($request->salary);
            }
            
            $user->save();

        }        

        return response()->json($user);

    }

    public function createSchedule($schedules, $id){
        

        foreach($schedules as $x){

            if($x['active'] == true) {

                $schedule = new Schedule();
                $schedule->user_id = $id;
                $schedule->check_in = $x['check_in'];
                $schedule->check_out =  $x['check_out'];
                // $schedule->description =  $x['description'];
                $schedule->day_id =  $x['day_id'];
                $schedule->active =  $x['active']; 
                $schedule->save();

            }
            
        }

    }

    public function createSalary($salary){
        $newSalary = new Salary();
        $newSalary->amount =  $salary['amount'];
        $newSalary->bonus = $salary['bonus'];
        $newSalary->salary_type_id =  $salary['salary_type_id'];
        $newSalary->description = $salary['description'];
        $newSalary->save();
        return $newSalary->id;
    }

    public function createMonthlyPayment($payment){
        $monthlyPayment = new MonthlyPayment();
        $monthlyPayment->amount = $payment['amount'];
        $monthlyPayment->description = $payment['description'];
        $monthlyPayment->save();
        return $monthlyPayment->id;
    }

    public function createReferences($references, $id){

        foreach($references as $x){

            $reference =  new Reference();

            $reference->user_id =  $id;
            $reference->name = $x['name'];
            $reference->phone = $x['phone'];
            $reference->email = $x['email'];
            $reference->phone2 = $x['phone2'];
            $reference->work_place = $x['work_place'];
            $reference->relationship_id  = $x['relationship_id'];

            $reference->save();
        }
        
    } 

    public function updateUser(Request $request, $id){

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;        
        $user->insurance = $request->insurance;
        $user->curp = $request->curp;
        $user->placeBirth = $request->placeBirth;
        $user->street = $request->street;
        $user->houseNumber = $request->houseNumber;
        $user->colony = $request->colony;
        $user->city = $request->city;
        $user->user_type_id = $request->user_type_id;

        if($request->password != NULL) 
            $user->password = bcrypt($request->password);

        if($user->user_type_id >= 2 && $user->user_type_id <= 4) {
            if($user->salary_id == NULL) {
                $user->salary_id = $this->createSalary($request->salary);
            }
        }

        $user->save();
        $user->fingerprint = NULL;
        
        return response()->json($user);
    }

    public function getSchedules($id){
        $schedules = Schedule::where('user_id', $id)->get();
        return response()->json($schedules);
    }

    public function updateSchedules(Request $request, $id){

        foreach($request->schedules as $x){

            if( isset( $x['id' ]) ){

                $schedule = Schedule::find($x['id']);

                $schedule->check_in = $x['check_in'];
                $schedule->check_out =  $x['check_out'];
                // $schedule->description =  $x['description'];
                // $schedule->day_id =  $x['day_id'];
                // $schedule->type = 1;
                $schedule->active =  $x['active']; 
                $schedule->save();

            } else {
                
                $schedule = new Schedule();

                $schedule->check_in = $x['check_in'];
                $schedule->check_out =  $x['check_out'];
                $schedule->user_id =  $x['user_id'];
                $schedule->day_id =  $x['day_id'];                
                $schedule->active =  true; 
                $schedule->save();

            }
            
        }

        if($request->user['user_type_id'] == 1) {

            $user = User::find($request->user['id']);
            
            $monthlyPayment = MonthlyPayment::find($user->monthly_payment_id);
            $monthlyPayment->amount = $request->amount;
            $monthlyPayment->save();
            
        }
        
        $schedules = Schedule::where('user_id', $request->user['id'])->get();

        return response()->json($schedules);
    }

    public function deleteSchedule($id) {

        Schedule::find($id)->delete();

        return 'true';

    }

    public function checkUniqueEmail(Request $request){
        $user =  User::where('email', $request->email)->first();
        if($user == NULL) return response()->json(true);
        else return response()->json(false);
    }

    public function checkUniqueName(Request $request){
        $user =  User::where('name', $request->name)->first();
        if($user == NULL) return response()->json(true);
        else return response()->json(false);
    }

    public function getStatus($id){
        $user = User::find($id);
        $status = RecordUserStatus::where('user_id', $id)->orderBy('id', 'desc')->get();

        return response()->json(['status' => $status, 'user' => $user]);

    }

    public function createStatus(Request $request){

        $user = User::find($request->user_id);

        $user->status = $request->status;

        $user->save();

        $creator = JWTAuth::parseToken()->authenticate();

        $record = new RecordUserStatus();
        $record->creator_id = $creator->id;
        $record->user_id = $user->id;
        $record->status = $request->status;
        $record->description = $request->description;
        $record->created_at = date_create();

        $record->save();

        $record = RecordUserStatus::find($record->id);

        return response()->json($record);

    }

    public function getMonthlyPayment($id) {
        return response()->json(MonthlyPayment::find($id));
    }

    public function getSalary($id) {
        return response()->json(Salary::find($id));
    }

    public function getReferences($id) {
        $references = Reference::where('user_id', $id)->get();
        return response()->json($references);
    }

    public function storeReference(Request $request) {
        
        $reference = new Reference();

        $reference->user_id = $request->user_id;
        $reference->name = $request->name;
        $reference->phone = $request->phone;
        $reference->phone2 = $request->phone2;
        $reference->email = $request->email;
        $reference->relationship_id = $request->relationship_id;
        $reference->work_place = $request->work_place;

        $reference->save();

        return response()->json($reference);

    }

    public function updateReference(Request $request) {
        
        $reference =  Reference::find($request->id);

        $reference->name = $request->name;
        $reference->phone = $request->phone;
        $reference->phone2 = $request->phone2;
        $reference->email = $request->email;
        $reference->relationship_id = $request->relationship_id;
        $reference->work_place = $request->work_place;

        $reference->save();

        return response()->json(true);

    }

    public function deleteReference($id) {

        $reference =  Reference::find($id);
        $reference->delete();

        return response()->json(true);
    }

    public function updateMonthlyPayment(Request $request){

        $monthly = MonthlyPayment::find($request->id);

        $monthly->amount = $request->amount;
        $monthly->save();

        return response()->json($monthly);
    }

    public function updateSalary(Request $re) {

        $salary = Salary::find($re->id);

        $salary->amount = $re->amount;
        $salary->bonus = $re->bonus;
        $salary->salary_type_id = $re->salary_type_id;

        $salary->save();

        return response()->json($salary);

    }

    public function saveImageProfile(Request $request) {

        $this->validate($request, [
            'image' => 'required|image',
            'user' => 'required'
        ]);

        $img = $request->file('image');
        $path = $this->getImagePath($img->getClientOriginalName());

        $image = Image::make($img);                

        // $image->resize(250, 250, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        
        $image->fit(250, 250);

        $image->save('images/app/users/' . $path);

        $user = User::find($request->user);

        if($user->img != NULL) {
            File::delete('images/app/users/' . $user->img);
        }
        
        $user->img = $path;
        $user->save();

        return response()->json($path);
    }


    public function checkSafeDelete(Request $request, $id)  {

        $user = User::find($id);

        $receipts = [];
        $debts = [];
        $sales = [];
        $payments = [];
        
        $secure = true;

        if($user->user_type_id == 1) {

            $receipts = Receipt::where('user_id', $user->id)->get();
            $debts = SaleDebt::where('user_id', $user->id)->get();

        } else if ($user->user_type_id == 2 ) {

            $debts = SaleDebt::where('user_id', $user->id)->get();
            $payments = Payment::where('user_id', $user->id)->get();

        } else if ( $user->user_type_id == 3) { 

            $debts = SaleDebt::where('user_id', $user->id)->get();
            $payments = Payment::where('user_id', $user->id)->get();
            $sales = Sale::where('creator_id', $user->id)->get();

        }


        return response()->json([ 
            'secure' => $secure, 
            'receipts' => count($receipts), 
            'debts' => count($debts),
            'sales' => count($sales),
            'payments' => count($payments)
            ]);
    }

    public function deleteUser($id) {

        $user = User::find($id);

        if($user->user_type_id == 1) {

            // Receipt::where('user_id', $user->id)->delete();
            // SaleDebt::where('user_id', $user->id)->delete();
            Schedule::where('user_id', $user->id)->delete();
            MonthlyPayment::where('id', $user->monthly_payment_id)->delete();
            Record::where('user_id', $user->id)->delete();
            RecordUserStatus::where('user_id', $user->id)->delete();
            Reference::where('user_id', $user->id)->delete();
            
        } else if($user->user_type_id == 2) { 

            
            // SaleDebt::where('user_id', $user->id)->delete();
            Schedule::where('user_id', $user->id)->delete();
            Salary::where('id', $user->salary_id)->delete();
            Record::where('user_id', $user->id)->delete();
            RecordUserStatus::where('user_id', $user->id)->delete();
            Reference::where('user_id', $user->id)->delete();

        } else if($user->user_type_id == 3) {

            Schedule::where('user_id', $user->id)->delete();
            Salary::where('id', $user->salary_id)->delete();
            Record::where('user_id', $user->id)->delete();
            RecordUserStatus::where('user_id', $user->id)->delete();
            Reference::where('user_id', $user->id)->delete();

        } else {

            Schedule::where('user_id', $user->id)->delete();
            Record::where('user_id', $user->id)->delete();
            RecordUserStatus::where('user_id', $user->id)->delete();
            Reference::where('user_id', $user->id)->delete();

        }

        $user->delete();

        return 'true';

    }
}
