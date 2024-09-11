<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //El sistema tendra 5 tipos de usuarios
        //El gerente, El directo de Area, El SubDirector de Area, El Auxiliar y El Pasante

        $superadmin = Role::create(['name' => 'SuperAdmin']);
        $gerente = Role::create(['name' => 'Gerente']);
        $directo = Role::create(['name' => 'Director']);
        $subdirecto = Role::create(['name' => 'Sub Director']);
        $pasante = Role::create(['name' => 'Pasante']);

        Permission::create(['name' => 'index'])->syncPermissions([$superadmin, $gerente, $directo]);
        Permission::create(['name' => 'home'])->syncPermissions([$superadmin, $gerente, $directo]);
        Permission::create(['name' => 'informaciones.reportes'])->syncRoles([$superadmin, $gerente, $directo, $pasante, $subdirecto]);
        Permission::create(['name' => 'informaciones.pdf'])->syncRoles([$superadmin, $gerente, $directo, $pasante, $subdirecto]);
        Permission::create(['name' => 'informaciones'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'inscripciones'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'usuarios'])->syncRoles([$superadmin, $gerente]);
        Permission::create(['name' => 'areas'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'generaciones'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'tarjetas'])->syncRoles([$superadmin, $gerente, $directo]);
        Permission::create(['name' => 'requisitos'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'extensiones'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'asignartarjetas'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'rfid'])->syncRoles([$superadmin, $gerente, $directo]);
        Permission::create(['name' => 'asistencia'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'asistencias'])->syncRoles([$superadmin, $gerente, $directo, $pasante, $subdirecto]);
        Permission::create(['name' => 'multas'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'actividads'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'programas'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'detalles'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'certificados'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);
        Permission::create(['name' => 'certificadopdf'])->syncRoles([$superadmin, $gerente, $directo, $subdirecto]);

        /* User::find(1)->assignRole($superadmin); */
 /*        User::find(2)->assignRole($gerente);
        User::find(3)->assignRole($directo);
        User::find(4)->assignRole($subdirecto);
        User::find(5)->assignRole($auxiliar);
        User::find(6)->assignRole($pasante); */
    }
}
