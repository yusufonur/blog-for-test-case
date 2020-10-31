<?php


namespace Support\ImageManager;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageManager
{
    public string $name;

    public string $disk;

    public string $path;

    public function __construct()
    {
        $this->name = md5(Str::random(10));

        $this->disk = "public";

        $this->path = "upload";
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setDisk(string $disk): self
    {
        $this->disk = $disk;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function uploadImageFromRequest(Request $request, $imageName = "image")
    {
        if (!$request->hasFile($imageName)) {
            return null;
        }

        $fullFileName = $this->name . "." . $request->$imageName->getClientOriginalExtension();

        $request->$imageName->storeAs(
            $this->path,
            $fullFileName,
            $this->disk
        );

        return $this->path . DIRECTORY_SEPARATOR . $fullFileName;
    }

    public function delete(string $path)
    {
        return Storage::disk($this->disk)
            ->delete($path);
    }
}
