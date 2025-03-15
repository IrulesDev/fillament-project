<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\TeacherResource;

class ViewTeacher extends ViewRecord
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
    public function index()
    {
        // Mengambil semua user yang memiliki role 'mentor'
        $mentors = User::role('mentor')->get();

        return view('mentors.index', compact('mentors'));
    }
}
