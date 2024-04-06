<?php 

namespace App\Services\Photos;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Qrcode;
use Illuminate\Support\Facades\Storage; 
use Inertia\Inertia;
class Service
{
    public function deleteFile($id)
    {
        $qrcode = Qrcode::find($id);
        if ($qrcode && Storage::disk('public')->exists('photos/' . basename($qrcode->photo))) {
            Storage::disk('public')->delete('photos/' . basename($qrcode->photo));
        }
    }
    public function downloadFile(Request $request)
{
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('public/photos');
        return $photoPath;
    }
    return null;
}


}