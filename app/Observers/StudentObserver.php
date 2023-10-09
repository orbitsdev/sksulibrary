<?php

namespace App\Observers;

use App\Models\Student;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Storage;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        $this->generateAndSaveQRCode($student);
    }

    protected function generateAndSaveQRCode(Student $student)
    {
        $qrCode = new DNS2D();

        // Generate the QR code data
        $qrCodeData = $qrCode->getBarcodePNG($student->id_number, 'QRCODE');

        // Generate a filename based on student information
        $lastName = $student->last_name ?? 'UnknownLastName';
        $firstName = $student->first_name ?? 'UnknownFirstName';
        $filename = strtoupper($lastName . '-' . $firstName . '-' . $student->id_number . '.png');

        // Define the path where the QR code image will be saved within the 'public' disk
        $folder = 'qrcodes';
        $filePath = $folder . '/' . $filename;

        // Save the QR code image to the 'public' disk
        Storage::disk('public')->put($filePath, base64_decode($qrCodeData));
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        $this->generateAndSaveQRCode($student);
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        $student->logins->each(function ($login) {
            // Delete the associated logout record (if exists)
            if ($login->logout) {
                $login->logout->delete();
            }



            // Delete the login record
            $login->delete();
        });

        if (!empty($student->profile)) {

            if (Storage::disk('public')->exists($student->profile)) {

                Storage::disk('public')->delete($student->profile);
            }
        }

        $lastName = $student->last_name ?? 'UnknownLastName';
        $firstName = $student->first_name ?? 'UnknownFirstName';
        $filename = strtoupper($lastName . '-' . $firstName . '-' . $student->id_number . '.png');
        $folder = 'qrcodes';
        $filePath = $folder . '/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
