<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Requisito;
use App\Models\Asignarrequisito;
use App\Models\Asignartarjeta;
use App\Models\Generacion;
use App\Models\Inscripcion;
use App\Models\User;
use App\Models\Multa;
use App\Models\Tarjeta;
use App\Models\Actividad;
use App\Models\Programa;
use App\Models\Informacion;
use App\Models\Extension;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $generaciones = [


            ['generacion' => '0','estado'=>'1','año'=>'2019'],

            ['generacion' => '1','estado'=>'1','año'=>'2020'],
            ['generacion' => '2','estado'=>'1','año'=>'2020'],
            ['generacion' => '3','estado'=>'1','año'=>'2020'],
            ['generacion' => '4','estado'=>'1','año'=>'2020'],


            ['generacion' => '5','estado'=>'1','año'=>'2021'],
            ['generacion' => '6','estado'=>'1','año'=>'2021'],
            ['generacion' => '7','estado'=>'1','año'=>'2021'],
            ['generacion' => '8','estado'=>'1','año'=>'2021'],

            ['generacion' => '9','estado'=>'1','año'=>'2022'],
            ['generacion' => '10','estado'=>'1','año'=>'2022'],
            ['generacion' => '11','estado'=>'1','año'=>'2022'],
            ['generacion' => '12','estado'=>'1','año'=>'2022'],

            ['generacion' => '13','estado'=>'1','año'=>'2023'],
            ['generacion' => '14','estado'=>'1','año'=>'2023'],
            ['generacion' => '15','estado'=>'1','año'=>'2023'],
            ['generacion' => '16','estado'=>'1','año'=>'2023'],

            ['generacion' => '17','estado'=>'1','año'=>'2024'],
            ['generacion' => '18','estado'=>'1','año'=>'2024'],
            ['generacion' => '19','estado'=>'1','año'=>'2024'],
            ['generacion' => '20','estado'=>'1','año'=>'2024'],
            // Puedes añadir más registros según sea necesario
        ];

        // Insertar los datos en la tabla Generacion
        foreach ($generaciones as $generacion) {
            Generacion::create($generacion);
        }

        $areas = [
            ['nombre_area' => 'FACEBOL SRL', 'sigla' => 'FAC', 'estado' => '1'],
            ['nombre_area' => 'SISTEMAS', 'sigla' => 'SIS', 'estado' => '1'],
            ['nombre_area' => 'CONTABILIDAD', 'sigla' => 'CON', 'estado' => '1'],
            ['nombre_area' => 'COMERCIAL', 'sigla' => 'COM', 'estado' => '1'],
            ['nombre_area' => 'ADMINISTRACION', 'sigla' => 'ADMI', 'estado' => '1'],
            ['nombre_area' => 'MARKETING', 'sigla' => 'MAR', 'estado' => '1'],
            ['nombre_area' => 'VOLUNTARIADOS', 'sigla' => 'VOL', 'estado' => '1'],
            // Puedes añadir más registros según sea necesario
        ];

        // Insertar los datos en la tabla Generacion
        foreach ($areas as $area) {
            Area::create($area);
        }

        $requisitos = [
            ['requisito' => 'CI'],
            ['requisito' => 'AGUA O LUZ'],
            ['requisito' => 'CROQUIS'],
            ['requisito' => 'PADRE, MADRE O TUTOR'],
            ['requisito' => 'HOJA DE VIDA'],
            ['requisito' => 'RECIBOS']
            // Puedes añadir más registros según sea necesario
        ];

        // Insertar los datos en la tabla Generacion
        foreach ($requisitos as $requisito) {
            Requisito::create($requisito);
        }


        Informacion::create([
            'apellido_paterno' => 'FACEBOL',
            'apellido_materno' => 'S.R.L',
            'nombre' => 'HAZLO DIFERENTE!',
            'celular' => '76266570',
            'insti_univer' => 'FACEBOL SRL',
            'carrera' => 'FACEBOL SRL',
            'año' => '2017',
            'invitado_visita' => 'FACEBOL SRL',

        ]);
        Extension::create([
            /*  'name' => 'SUPER ADMINISTRADOR', */
             'ciudad' => 'La Paz',
             'expedido' => 'LP',
        ]);
        Inscripcion::create([
            'estado' => 1,
            'f_inscripcion' => '2024-07-03',
            'recibos' => '00009',
            /* 'email' => 'facebolsrl@gmail.com', */
            'porcentaje_requisitos' => '100',
            'direccion' => 'facebol',
            'ci' => '1111111',
            'genero' => '1',
            'codigo_credencial' => 'FACE01',
            'id_informacion' => '1',
            'id_generacion' => '1',
            'id_area' => '1',
            'id_extension' => '1',

        ]);
        $this->call([RoleSeeder::class]);
        
        User::create([
           /*  'name' => 'SUPER ADMINISTRADOR', */
            'email' => 'facebolsrl@gmail.com',
            'password' => Hash::make('facebol12345?'),
            'estado' => '1',
            'codigo_credencial' => 'FACE01',
            'id_role' => 1,
        ]);
       /*  User::create([
            'name' => 'GERENTE GENERAL',
            'email' => 'facebolsrl@gmail.com',
            'password' => Hash::make('facebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'DIRECTOR DE SISTEMA',
            'email' => 'sistemasfacebolsrl@gmail.com',
            'password' => Hash::make('sistemasfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'DIRECTO DE COMERCIAL',
            'email' => 'comercialfacebolsrl@gmail.com',
            'password' => Hash::make('comercialfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'DIRECTOR DE MARKETING',
            'email' => 'marketingfacebolsrl@gmail.com',
            'password' => Hash::make('marketingfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'DIRECTOR DE ADMINISTRACIÓN',
            'email' => 'administracionfacebolsrl@gmail.com',
            'password' => Hash::make('administracionfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'DIRECTOR DE CONTABILIDAD',
            'email' => 'contabilidadfacebolsrl@gmail.com',
            'password' => Hash::make('contabilidadfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'SUBDIRECTOR DE SISTEMA',
            'email' => 'subdsisfacebolsrl@gmail.com',
            'password' => Hash::make('subdsisfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'SUBDIRECTO DE COMERCIAL',
            'email' => 'subdcomfacebolsrl@gmail.com',
            'password' => Hash::make('subdcomfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'SUBDIRECTO DE MARKETING',
            'email' => 'subdmarfacebolsrl@gmail.com',
            'password' => Hash::make('subdmarfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'SUBDIRECTO DE ADMINISTRACION',
            'email' => 'subdadmfacebolsrl@gmail.com',
            'password' => Hash::make('subdadmfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'SUBDIRECTO DE CONTABILIDAD',
            'email' => 'subdconfacebolsrl@gmail.com',
            'password' => Hash::make('subdconfacebolsrl?'),
            'estado' => '1',

        ]);
        User::create([
            'name' => 'AUXILIAR DE SISTEMAS',
            'email' => 'auxisisfacebolsrl@gmail.com',
            'password' => Hash::make('auxisisfacebolsrl?'),
            'estado' => '1',
        ]);
        User::create([
            'name' => 'AUXILIAR DE COMERCIAL',
            'email' => 'auxicomfacebolsrl@gmail.com',
            'password' => Hash::make('auxicomfacebolsrl?'),
            'estado' => '1',
        ]);
        User::create([
            'name' => 'AUXILIAR DE MARKETING',
            'email' => 'auximarfacebolsrl@gmail.com',
            'password' => Hash::make('auximarfacebolsrl?'),
            'estado' => '1',
        ]);
        User::create([
            'name' => 'AUXILIAR DE ADMINISTRACION',
            'email' => 'auxiadmfacebolsrl@gmail.com',
            'password' => Hash::make('auxiadmfacebolsrl?'),
            'estado' => '1',
        ]);
        User::create([
            'name' => 'AUXILIAR DE CONTABILIDAD',
            'email' => 'auxiconfacebolsrl@gmail.com',
            'password' => Hash::make('auxiconfacebolsrl?'),
            'estado' => '1',
        ]);
        User::create([
            'name' => 'PASANTES FACEBOL S.R.L.',
            'email' => 'pasantesfacebolsrl@gmail.com',
            'password' => Hash::make('pasantesfacebolsrl?'),
            'estado' => '1',
        ]); */





        Tarjeta::create([
            'serie' => "DSFSD89F",
            'estado' => 1,
            //'estado' => '1',
        ]);


        $multas = [
            ['nombre_multa' => 'ATRASO0','monto' => '0','p1' => '09:00:00','p2' => '09:10:59','turno' => '1'],
            ['nombre_multa' => 'ATRASO1','monto' => '1','p1' => '09:11:00','p2' => '09:15:59','turno' => '1'],
            ['nombre_multa' => 'ATRASO2','monto' => '2','p1' => '09:16:00','p2' => '09:30:59','turno' => '1'],
            ['nombre_multa' => 'ATRASO3','monto' => '3','p1' => '09:31:00','p2' => '10:00:59','turno' => '1'],
            ['nombre_multa' => 'ATRASO5','monto' => '5','p1' => '10:01:00','p2' => '13:00:59','turno' => '1'],
            ['nombre_multa' => 'ATRASO0','monto' => '0','p1' => '14:00:00','p2' => '14:10:59','turno' => '0'],
            ['nombre_multa' => 'ATRASO1','monto' => '1','p1' => '14:11:00','p2' => '14:15:59','turno' => '0'],
            ['nombre_multa' => 'ATRASO2','monto' => '2','p1' => '14:16:00','p2' => '14:30:59','turno' => '0'],
            ['nombre_multa' => 'ATRASO3','monto' => '3','p1' => '14:31:00','p2' => '15:00:59','turno' => '0'],
            ['nombre_multa' => 'ATRASO5','monto' => '5','p1' => '15:01:00','p2' => '18:00:59','turno' => '0'],
            ['nombre_multa' => 'TOLERANCIAM','monto' => '0','p1' => '09:00:00','p2' => '13:00:59','turno' => '1'],
            ['nombre_multa' => 'TOLERANCIAT','monto' => '0','p1' => '14:00:00','p2' => '18:00:59','turno' => '0'],

            // Puedes añadir más registros según sea necesario
        ];

        // Insertar los datos en la tabla Generacion
        foreach ($multas as $multa) {
            Multa::create($multa);
        }

        $actividads = [
            ['nombre_actividad' => 'NINGUNA'],
            ['nombre_actividad' => 'CAMPAÑA'],
            ['nombre_actividad' => 'CONVOCATORIA'],

            // Puedes añadir más registros según sea necesario
        ];

        // Insertar los datos en la tabla Generacion
        foreach ($actividads as $actvidad) {
            Actividad::create($actvidad);
        }

    }
}
