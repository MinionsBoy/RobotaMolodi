<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Vacancy extends Model {


    protected $table = 'vacancies';
    protected $fillable = ['position','company_id','branch','organisation', 'date_field', 'salary','city', 'description','user_email'];



    public function getVacancies()
    {

        //return $this->latest()->get();
    }

    public function ReadCompany()
    {
        $company = $this->belongsTo('App\Models\Company','company_id')->get();
        return $company[0];
    }

    public function CreateVacancy($array)
    {

        $position = $array['position'];
        $galuz = $array['galuz'];
        $organisation = $array['organisation'];
        $date = $array['date'];
        $salary = $array['salary'];
        $city = $array['city'];
        $description = $array['description'];

        DB::table('vacancies')->insert(
            array(
                'position' => $position,
                'branch' => $galuz,
                'organisation' => $organisation,
                'salary' => $salary,
                'city' => $city,
                'description' => $description,
                'date_field' => $date,
                'created_at' => $date,
                'updated_at' => $date
            )

        );

    }
    public function fillVacancy($id,$auth,$company,$request)
    {

        $position = $request['Position'];
        $branch = $request['branch'];
        $organisation = $request['Organisation'];
        $date = $request['Date'];
        $salary = $request['Salary'];
        $city = $request['City'];
        $desription = $request['Description'];
        $userEmail = $request['user_email'];

        $companyId = $company->companyName($organisation);
        //dd($companyId);
        if($id!=0){
        $vacancy = Vacancy::find($id);
        }
        else
        {
            $vacancy = new Vacancy();
        }
        $vacancy->position = $position;
        $vacancy->branch = $branch;
        $vacancy->organisation = $organisation;
        $vacancy->date_field = $date;
        $vacancy->salary = $salary;
        $vacancy->city = $city;
        $vacancy->description = $desription;
        $vacancy->company_id = $companyId[0]->id;
        $vacancy->user_email = $userEmail;

        return $vacancy;
    }
	//


}
