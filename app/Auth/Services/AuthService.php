<?

namespace App\Auth\Services;

class AuthService {

    public function login(array $data) : array
    {

        $email   = $data['email'];
        $password = $data['password'];

        if(!$token = auth()->guard('api')->attempt(['email' => $email, 'password' => $password])){
            $token = false;
        }

        $user = auth()->guard('api')->user();
        $user['token'] = $token;

        return ['user' => $user];

    }
}