<?php

namespace Database\Seeders;

use App\Models\activities;
use App\Models\assessment;
use App\Models\Atendance;
use App\Models\attachment;
use App\Models\AttachmentSantri;
use App\Models\departement;
use App\Models\FinancialRecord;
use App\Models\KelasSantri;
use App\Models\Leason;
use App\Models\news;
use App\Models\permission;
use App\Models\ProgramStage;
use App\Models\RapotSantri;
use App\Models\SantriFamily;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $program_stageData = ProgramStage::factory(10)->create();
        $kelasData = KelasSantri::factory(10)->create();
        $userData = user::factory(1000)->create();
        $departementData = departement::factory(100)->create();
        $permissionData = permission::factory(100)->create();
        $assessmentData = assessment::factory(10)->create();
        $rapot_santriData = RapotSantri::factory(100)->create();
        $leasonData = Leason::factory(10)->create();
        $santri_familyData = SantriFamily::factory(10)->create();
        $attachmentData = attachment::factory(10)->create();
        $financial_recordData = FinancialRecord::factory(10)->create();
        $attendaceData = Atendance::factory(10)->create();
        $activiesData = activities::factory(10)->create();
        $newsData = news::factory(10)->create();
        $attachment_santriData = AttachmentSantri::factory(10)->create();

        foreach($userData as $data){
            $data->update([
                'kelas_id' => KelasSantri::all()->random()->id,
                'departement_id' => departement::all()->random()->id,
                'program_stage_id' => ProgramStage::all()->random()->id
            ]);
        }

        foreach($kelasData as $data){
            $data->update([
                'mentor_id' => User::all()->random()->id,
            ]);
        }

        foreach($departementData as $data){
            $data->update([
                'leader_id' => User::all()->random()->id,
                'co_leader_id' => User::all()->random()->id,
            ]);
        }

        foreach($permissionData as $data){
            $data->update([
                'user_id' => User::all()->random()->id,
            ]);
        }

        foreach($assessmentData as $data){
            $data->update([
                'user_id' => User::all()->random()->id,
                'lesson_id' => leason::all()->random()->id,
            ]);
        }

        foreach($rapot_santriData as $data){
            $data->update([
                'santri_id' => User::all()->random()->id,
            ]);
        }

        foreach($leasonData as $data){
            $data->update([
                'kelas_santri_id' => KelasSantri::all()->random()->id,
            ]);
        }

        foreach($santri_familyData as $data){
            $data->update([
                'santri_id' => User::all()->random()->id,
            ]);
        }

        foreach($financial_recordData as $data){
            $data->update([
                'accounting_id' => User::all()->random()->id,
            ]);
        }

        foreach($attendaceData as $data){
            $data->update([
                'santri_id' => User::all()->random()->id,
                'activity_id' => activities::all()->random()->id,
            ]);
        }

        foreach($newsData as $data){
            $data->update([
                'autor_id' => User::all()->random()->id,
            ]);
        }

        foreach($attachment_santriData as $data){
            $data->update([
                'santri_id' => User::all()->random()->id,
                'attachment_id' => User::all()->random()->id,
            ]);
        }


    }
}
