<?php

namespace App\Http\Controllers;

use App\Models\TrueFalse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class TrueFalseController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checkbox = TrueFalse::first();

        return response()->json([
            'data' => $checkbox,
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Update
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'answer' => 'required',
            'question' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400]);
        }

        $x = $request->question;
        $checkbox = TrueFalse::find(1)->get('a' . $x);
        foreach ($checkbox as $quizval) {
            if($quizval['a'.$x] == 'a'){
                $btn = 'btn1';
            }
            if($quizval['a'.$x] == 'b'){
                $btn = 'btn2';
            }
            if ($quizval['a' . $x] == $request->answer) {
                return response()->json([
                    'data' => $btn,
                    'message' => 'Correct!',
                    'status' => Response::HTTP_ACCEPTED
                ]);
            }
            return response()->json([
                'data' => $btn,
                'message' => 'Incorrect!',
                'status' => Response::HTTP_ACCEPTED
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkbox = TrueFalse::find($id);

        return response()->json([
            'data' => $checkbox,
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'grade' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400]);
        }

        $postdata = [
            'user_id' => auth()->id(),
            'quiz_id' => $request->id,
            'grade' => $request->grade,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Grades::insert($postdata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}