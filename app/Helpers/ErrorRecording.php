<?php
namespace App\Helpers;
 
use App\Models\ErrorReporting;
use Illuminate\Database\QueryException;

class ErrorRecording {
    public function ErrorRecords($error, $messages, $url, $user)
    {
        /**
         * Helpers Name : Error Reporting
         * Description : Grabing all error processing and recorded to databases
         * Error Code :
         * Data Master 
         * - 100 : Error Create Post
         * - 101 : Error Edit Post
         * - 102 : Error Delete Post
         * - 103 : Error Decrypt
         * - 104 : Error Another
         */
        try {
            $push[] = [
                "error_code"=>$error,
                "message_error" => $messages,
                "url" => $url,
                "user_id" => $user
            ]; 
            ErrorReporting::insert($push);
            return true;
        } catch (QueryException $e) {
            //throw $th;
            throw $e;
        }
    }
}