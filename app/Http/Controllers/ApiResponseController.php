<?php

namespace app\Http\Controllers;

use \app\Http\Controllers\Controller;
use app\Services\AdapterLog;
use app\Transformer\PatientTransformer;
use Illuminate\Http\Request;
use Response;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ApiResponseController extends Controller
{
    protected $statusCode = 200;
    const CODE_WRONG_ARGS = 'CTX-WRONG-ARGS';
    const CODE_NOT_FOUND = 'CTX-NOT-FOUND';
    const CODE_INTERNAL_ERROR = 'CTX-INTERNAL-ERROR';
    const CODE_UNAUTHORIZED = 'CTX-UNAUTHORIZED';
    const CODE_FORBIDDEN = 'CTX-FORBIDDEN';
    const CODE_SUCCESSFULL = 'CTX-SUCCESS';
    protected static $appname;


    public function __construct()
    {
        $fractal = new Manager();
        self::$appname = \Config::get('app.appname');
        $this->fractal = $fractal;

        if (isset($_GET['include'])) {
            $this->fractal->parseIncludes($_GET['include']);
        }
    }

    public static function logDB(){
        if(env('APP_ENV')=='local') {
            $query = DB::getQueryLog();
            $lastQuery = end($query);
            AdapterLog::log($lastQuery);
            //return var_dump($lastQuery);
        }
    }

    /**
     * Getter for statusCode.
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter for statusCode.
     *
     * @param int $statusCode Value to set
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }


    protected  function responseActivation($data, $parms){
        $class = "app\\Transformer\\".ucwords($parms['function'])."Transformer";
        if(!class_exists($class)){
            $error = [
                'code' => 503,
                'message' =>"Request Service is not available"
            ];
            AdapterLog::log($class." does not exist at ".__METHOD__.":".__LINE__,'warning');
            $this->errorNotFound($error['message']);
            exit(json_encode($error));
        }
        //Step 6
        return $class::transform($data, $parms);
    }

    protected  function responWithApi($data, $parms){
        $class = "app\\Transformer\\".ucwords($parms['function'])."Transformer";
        if(!class_exists($class)){
            $error = [
                'code' => 503,
                'message' =>"Request Service is not available"
            ];
            AdapterLog::log($class." does not exist at ".__METHOD__.":".__LINE__,'warning');
            $this->errorNotFound($error['message']);
            exit(json_encode($error));
        }
        //Step 6
        return $class::transform($data, $parms);
    }

    protected  function responWithLocal($data, $parms){
        $class = "app\\Transformer\\".ucwords($parms['function'])."Transformer";
        if(!class_exists($class)){
            $error = [
                'code' => 503,
                'message' =>"Request Service is not available"
            ];
            AdapterLog::log($class." does not exist at ".__METHOD__.":".__LINE__,'warning');
            $this->errorNotFound($error['message']);
            exit(json_encode($error));
        }
        return $class::transform($data, $parms);
    }

    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);

        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        $response = Response::json($array, $this->statusCode, $headers);

        // $response->header('Content-Type', 'application/json');

        return $response;
    }

    protected function respondWithError($message, $errorCode, $data=null)
    {
        if ($this->statusCode === 200) {
         /*   trigger_error(
                'You are good, your status is 200...',
                E_USER_WARNING
            );*/
        }
        $reponse =  [
            'response' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ];
        if($data) {
            $reponse['response']['data'] = $data;
        }

        return $this->respondWithArray($reponse);
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
            ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
            ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
            ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
            ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
            ->respondWithError($message, self::CODE_WRONG_ARGS);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @return Response
     */
    public function successfullReponse($message = 'Your request has been successfully completed', $data=null)
    {
        return $this->setStatusCode(200)
            ->respondWithError($message, self::CODE_SUCCESSFULL, $data);
    }

    public function getToken(Request $request)
    {
        return response()->json(['token' => csrf_token()]);
    }

    public function getCredentialsFromHeader()
    {

        return response()->json(['wohoo' => 'Caretraxx rocks!']);

        $ha = base64_decode(substr(\Request::header('Authorization'), 6));
        list($email, $empid) = explode(':', $ha);

        return array(
            'email' => $email,
            'empid' => $empid
        );
    }

    /**
     * Generates a Response with a 200 HTTP header and a given message.
     *
     * @return User authenticate method
     */
    public function authenticate()
    {
        // $header = $this->getCredentialsFromHeader();
        // $email = $header['email'];
        // $password = $header['password'];

        $ha = base64_decode(substr(\Request::header('Authorization'), 6));
        list($email, $password) = explode(':', $ha);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return $this->respondWithArray(['message' => 'Welcome!']);
        } else {
            return $this->errorUnauthorized();
        }
    }
}
