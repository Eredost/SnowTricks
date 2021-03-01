<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    /** @var SluggerInterface $slugger */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file, $path): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid('', true).'.'.$file->guessExtension();

        $file->move(
            $path,
            $newFilename
        );

        return $newFilename;
    }
}
