<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserAdmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_admins'; // Se necessário, especifique o nome da tabela

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'type', 'status',
    ];

    /**
     * Os atributos que não podem ser atribuíveis em massa.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Verifica se as credenciais do usuário são válidas.
     *
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(array $credentials)
    {
        // Verifique se a senha fornecida corresponde à senha armazenada no banco de dados
        return Hash::check($credentials['password'], $this->getAuthPassword());
    }

    /**
     * Obtém o nome do campo de identificação.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id'; // O nome do campo de identificação (normalmente 'id')
    }

    /**
     * Obtém o valor do campo de identificação.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey(); // O valor do campo de identificação (normalmente a chave primária)
    }

    /**
     * Obtém o nome do campo de senha.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password; // O nome do campo de senha (normalmente 'password')
    }
}
