namespace App\Services;

use App\Repositories\UserRepository;

class AuthService {
    protected $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function checkLogin($username, $password) {
        $user = $this->userRepo->findByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            return true;
        }
        return false;
    }
}
