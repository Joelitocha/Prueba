<?php

namespace App\Controllers;

use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use CodeIgniter\RESTful\ResourceController;

class Purchases extends ResourceController
{
    protected $format = 'json';

<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PurchaseModel;
use App\Models\EmpresaModel;
use App\Models\UserModel;

class Purchases extends ResourceController
{
    protected $format = 'json';

    private function generateEcode(): string
    {
        return strtoupper(substr(bin2hex(random_bytes(6)), 0, 12));
    }

    private function generatePassword(int $length = 8): string
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
    }

    private function createUserForCompany(array $data)
    {
        $userModel = new UserModel();

        $password = $this->generatePassword();
        $userData = [
            'email'    => $data['email'],
            'name'     => $data['company_name'], // o el contacto si querés
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'empresa_id' => $data['empresa_id'], // si tu tabla usuarios tiene empresa_id
            'role_id'  => 2 // supongamos que 2 = Usuario normal
        ];

        $userId = $userModel->insert($userData, true);

        if ($userId) {
            // Mandar mail con credenciales
            $this->sendCredentialsMail($data['email'], $password);
        }

        return $userId;
    }

    private function sendCredentialsMail(string $email, string $password)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setSubject('Tus credenciales de RackON');
        $emailService->setMessage("Hola, tu cuenta fue creada.\n\nEmail: $email\nPassword: $password");

        if (!$emailService->send()) {
            log_message('error', 'Error al enviar mail a ' . $email);
        }
    }

    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->fail('Método no permitido', 405);
        }

        $json = $this->request->getJSON(true);

        if (!$json || empty($json['email']) || empty($json['company_name'])) {
            return $this->fail('Datos incompletos', 400);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $purchaseModel = new PurchaseModel();
            $empresaModel  = new EmpresaModel();

            // 1. Insertar compra
            $insertId = $purchaseModel->insert($json, true);
            if (!$insertId) {
                return $this->failValidationErrors($purchaseModel->errors());
            }

            // 2. Insertar empresa con nombre + Ecode
            $ecode = $this->generateEcode();
            $idEmpresa = $empresaModel->insert([
                'nombre' => $json['company_name'],
                'Ecode'  => $ecode
            ], true);

            // 3. Relacionar compra con empresa
            $purchaseModel->update($insertId, ['empresa_id' => $idEmpresa]);

            // 4. Crear usuario vinculado a empresa y mandar mail
            $userId = $this->createUserForCompany([
                'email' => $json['email'],
                'company_name' => $json['company_name'],
                'empresa_id' => $idEmpresa
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->failServerError('Error al guardar datos relacionados');
            }

            return $this->respondCreated([
                'status'       => 'success',
                'message'      => 'Compra, empresa y usuario registrados exitosamente',
                'purchase_id'  => $insertId,
                'empresa_id'   => $idEmpresa,
                'user_id'      => $userId,
                'ecode'        => $ecode
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en Purchases::save - ' . $e->getMessage());
            return $this->failServerError('Error interno del servidor');
        }
    }
}

}
