namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users'; // bảng trong DB
    protected $fillable = ['username', 'password'];
    public $timestamps = true; // nếu không dùng created_at, updated_at
}
