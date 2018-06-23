<?php

namespace App\Http\Controllers;

use App\resume;
use function foo\func;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class resumeController extends Controller
{
    public function index()
    {
        $resume = new resume();
        $resumeArticle = $resume->select("updated_at")->get();
        return view("resume.index",[
            "resume"=>$resumeArticle
        ]);
    }

    public function article()
    {
        $resume = new resume();
        $resumeArticle = $resume->select("resume")->get();
        return view("resume.article",[
            "resume"=>$resumeArticle
        ]);
    }

    public function login(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("resume.login", [
                "error" => ""
            ]);
        } else {
            if ($request->input("user_email") == null) {
                return view("resume.login", [
                    "error" => "Please type your Email"
                ]);
            } else {
                if ($request->input("user_password") == null) {
                    return view("resume.login", [
                        "error" => "Please type your password"
                    ]);
                } else {
                    $useremail = $request->input("user_email");
                    $password = $request->input("user_password");
                    $databasePassword = DB::table("user")
                        ->where("Email", "=", $useremail)
                        ->select("password")
                        ->first();
                    if ($databasePassword == null) {
                        return view("resume.login", [
                            "error" => "User does not exist"
                        ]);
                    } else {
                        if (Hash::check($password, $databasePassword->password)) {
                            session(["useremail" => $useremail]);
                            return redirect("admin");
                        } else {
                            return view("resume.login", [
                                "error" => "Wrong password"
                            ]);
                        }
                    }

                }
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod("get")) {
            return view("resume.register", [
                "error" => ""
            ]);
        } else {
//        email
            if ($request->input("user_email") == null) {
                return view("resume.register", [
                    "error" => "Please type your Email"
                ]);
            } else {
//            username
                if ($request->input("user_name") == null) {
                    return view("resume.register", [
                        "error" => "Please type your username"
                    ]);
                } else {
//                password
                    if ($request->input("user_password") == null) {
                        return view("resume.register", [
                            "error" => "Please type your password"
                        ]);
                    } else {
                        $password = Hash::make($request->input("user_password"));
                        $email = $request->input("user_email");
                        $username = $request->input("user_name");
                        $status = DB::table("user")->insert(
                            ["Email" => $email, "username" => $username, "password" => $password]
                        );
                        if ($status == true) {
                            return "注册成功";
                        } else {
                            return "注册失败";
                        }
                    }
                }
            }
        }
    }

    public function admin(Request $request)
    {
        if ($request->isMethod("get")) {
            $useremail = session("useremail");
            return view("resume.admin", [
                "error" => "",
                "useremail" => $useremail
            ]);
        } else {
            $useremail = session("useremail");
            $resume = $request->input("resume");
            $job = $request->input("job");
            if ($job == null) {
                return view("resume.admin", [
                    "error" => "Please type your job",
                    "useremail" => $useremail
                ]);
            } else {
                if ($resume == null) {
                    return view("resume.admin", [
                        "error" => "Please type your resume",
                        "useremail" => $useremail
                    ]);
                } else {
                    $userID = DB::table("user")
                        ->where("Email", "=", $useremail)
                        ->select("id")
                        ->first()
                        ->id;
                    $resumeModel = new resume();
                    $resumeModel->resume = $resume;
                    $resumeModel->userID = $userID;
                    $resumeModel->job = $job;
                    $status = $resumeModel->save();
                    if ($status == true) {
                        return view("resume.admin", [
                            "error" => "Submit success",
                            "useremail" => $useremail
                        ]);
                    } else {
                        return view("resume.admin", [
                            "error" => "Submit fail please content a1349636970@gmail.com",
                            "useremail" => $useremail
                        ]);
                    }
                }

            }
        }
    }

    public function edtior()
    {
        $useremail = session("useremail");
        $userID = DB::table("user")
            ->where("Email", "=", $useremail)
            ->select("id")
            ->first()
            ->id;
        $resume = new resume();
        $resumeArticle = $resume
            ->where('userID', '=', $userID)
            ->select("resume", "created_at", "updated_at", "job")
            ->get();
        return view("resume.editor", [
            "error" => "",
            "useremail" => $useremail,
            "resume" => $resumeArticle,
        ]);
    }

    public function workspace(Request $request)
    {
        $resume = new resume();
        $useremail = session("useremail");
        if ($request->isMethod("post")) {
            $createTime = $request->input("createTime");
            $updateJob = $request->input("updated_job");
            $updateResume = $request->input("updated_resume");
            $resumeUpdate = $resume->where("created_at", "=", $createTime)->first();
            $resumeUpdate->resume = $updateResume;
            $resumeUpdate->job = $updateJob;
            $status = $resumeUpdate->save();
            if ($status == true) {
                return redirect()->action("resumeController@edtior")->with("status", "update success");
            } else {
                return view("resume.workspace", [
                    "error" => "update fail",
                    "useremail" => $useremail
                ]);
            }
        } else {
            $createTime = $request->input("createTime");
            $resumeArticle = $resume
                ->where("created_at", "=", $createTime)
                ->select("resume")
                ->first()
                ->resume;
            $resumeJob = $resume
                ->where("created_at", "=", $createTime)
                ->select("job")
                ->first()
                ->job;
            return view("resume.workspace", [
                "error" => "",
                "useremail" => $useremail,
                "resumeArticle" => $resumeArticle,
                "resumeJob" => $resumeJob,
                "createTime" => $createTime
            ]);
        }
    }

    public function delete(Request $request)
    {
        $status = $request->input("status");
        $createTime = $request->input('createTime');
        if ($status == "true") {
            $resume = new resume();
            $resume->where("created_at", '=', $createTime)->delete();
            $useremail = session("useremail");
            $userID = DB::table("user")
                ->where("Email", "=", $useremail)
                ->select("id")
                ->first()
                ->id;
            $resume = new resume();
            $resumeArticle = $resume
                ->where('userID', '=', $userID)
                ->select("resume", "created_at", "updated_at", "job")
                ->get();
            return view("resume.delete", [
                "error" => "",
                "useremail" => $useremail,
                "resume" => $resumeArticle,
            ]);
        } else {
            $useremail = session("useremail");
            $userID = DB::table("user")
                ->where("Email", "=", $useremail)
                ->select("id")
                ->first()
                ->id;
            $resume = new resume();
            $resumeArticle = $resume
                ->where('userID', '=', $userID)
                ->select("resume", "created_at", "updated_at", "job")
                ->get();
            return view("resume.delete", [
                "error" => "",
                "useremail" => $useremail,
                "resume" => $resumeArticle,
            ]);
        }
    }
    public function confirm(Request $request)
    {
        $createTime = $request->input('createTime');
        if ($createTime == null) {
            return redirect()->action("resumeController@delete")->with("status", "fail1");
        } else {
            return view("resume.confirm");
        }
    }

    public function check()
    {
        $useremail = session("useremail");
        $userID = DB::table("user")
            ->where("Email", "=", $useremail)
            ->select("id")
            ->first()
            ->id;
        $resume = new resume();
        $resumeArticle = $resume
            ->where('userID', '=', $userID)
            ->select("resume", "created_at", "updated_at", "job")
            ->get();
        return view("resume.check", [
            "error" => "",
            "useremail" => $useremail,
            "resume" => $resumeArticle,
        ]);
    }
}