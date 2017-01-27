<?php
namespaceAppHttpControllers;
useIlluminateHttpRequest;
useDB;
useExcel;
class ImportExcelController extends Controller

{
    /*
    *	Import from Excel
    */
    public

    function index(Request $request)
    {
        if ($request->file('import_file'))
        {
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path,
                function ($reader)
                {
                })->get();
            if (!empty($data) && $data->count())
            {
                foreach($data->toArray() as $key => $value)
                {
                    if (!empty($value))
                    {
                        foreach($value as $v)
                        {
                            if (isset($v["first_name"]) && isset($v["last_name"]) && isset($v["password"]))
                            {
                                $error = "";
                                if (!preg_match("/^[a-zA-Z ]*$/", $v['first_name']) || (!preg_match("/^[a-zA-Z ]*$/", $v['last_name'])))
                                {
                                    return $error = "Only letters and white space allowed in first name & last name";
                                }

                                if ((!is_numeric($v['num'])) || (!is_numeric($v['num1'])) || (!is_numeric($v['num2'])))
                                {
                                    return $error = "num1 & num2 & num3 must be a number !";
                                }

                                if (!filter_var($v['email'], FILTER_VALIDATE_EMAIL))
                                {
                                    return $error = "Invalid email format";
                                }

                                if (!preg_match("/^[0-9]*$/", $v['phone_number']) || strlen($v['phone_number']) != 9)
                                {
                                    return $error = "Invalid phone number";
                                }

                                if (!preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/', $v['password']))
                                {
                                    return $error = nl2br("the password does not meet the requirements! : \n
                               
                                *at least one lowercase char \n
                               *at least one uppercase char \n
                                *at least one digit \n
                                *at least one special sign of @#-_$%^&+=§!?
                                ");
                                }

                                if (!$error)
                                {
                                    $insert[] = ['num' => $v['num'], 'num1' => $v['num1'], 'num2' => $v['num2'], 'first_name' => $v['first_name'], 'last_name' => $v['last_name'], 'email' => $v['email'], 'phone_number' => $v['phone_number'], 'address' => $v['address'], 'password' => $v['password'], 'created_at' => $v['created_at']];
                                }
                            }
                            else
                            {
                                return "first name & last name & password fields are required!";
                            }
                        }
                    }
                }

                if (!empty($insert))
                {
                    DB::table('items')->insert($insert);
                    return view('data')->withData($data);
                }
            }

            return back()->with('error', 'Please Check your file, Something is wrong there.');
        }
        else
        {
            return "Please add a file !";
        }
    }
}