<?php

namespace Database\Seeders;

use App\Models\Activities;
use App\Models\Assessment;
use App\Models\Atendance;
use App\Models\Attachment;
use App\Models\AttachmentSantri;
use App\Models\Classpit;
use App\Models\Departement;
use App\Models\FinancialRecord;
use App\Models\KelasSantri;
use App\Models\Leason;
use App\Models\News;
use App\Models\Permission;
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
        $userData = user::factory(100)->create();
        $departementData = Departement::factory(100)->create();
        $permissionData = Permission::factory(100)->create();
        $assessmentData = Assessment::factory(100)->create();
        $rapot_santriData = RapotSantri::factory(100)->create();
        $leasonData = Leason::factory(100)->create();
        $santri_familyData = SantriFamily::factory(100)->create();
        $attachmentData = Attachment::factory(10)->create();
        $financial_recordData = FinancialRecord::factory(10)->create();
        $attendaceData = Atendance::factory(10)->create();
        $activiesData = Activities::factory(10)->create();
        $newsData = News::factory(10)->create();
        $attachment_santriData = AttachmentSantri::factory(10)->create();

        foreach($userData as $data){
            $data->update([
                'kelas_id' => KelasSantri::all()->random()->id,
                'departement_id' => Departement::all()->random()->id,
                'program_stage_id' => ProgramStage::all()->random()->id,
                // 'santri_family_id' => SantriFamily::all()->random()->id,
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
                'user_id' => User::all()->random()->id,
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
