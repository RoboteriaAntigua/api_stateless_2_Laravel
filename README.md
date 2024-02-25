# Api stateless con sanctum 2

# Creendenciales en el .env

# php artisan migrate

# Cremos un controlador para Auth
    php artisan make:controller -r

# Para conectarse con ANgular en pruebas locales, habilitar cors
    -config/cors.php
    'paths' => ['*'],   //CUbriria todas las rutas
    o mejor practica por:
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'register', 'logout'], //Agregar cada una de las rutas nesesarias
    Ademas:
    'supports_credentials' => true,


# Rutas:
    Route::middleware('auth:sanctum')->group( function(){
    Route::get('/', [AuthController::class,'index']);
    //Rutas de la api
    }
    );

    Route::controller(AuthController::class)->group( function() {
        Route::post('/register','store');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout');
        Route::post('/resetPassword', 'update');
    });

# Mejorar el controlador con metodos para resetear password, y modificar usuario. 

# Authenticacion para spa:
    Para esta función, Sanctum no utiliza tokens de ningún tipo. En su lugar, Sanctum utiliza los servicios de autenticación de sesión basados en cookies incorporados en Laravel.
    Seria para apis statefull