<?php

declare(strict_types=1);

namespace App\Repository\Genre;

use App\Models\Genre;
use App\Repository\GenreRepository as GenreRepositoryInterface;

class GenreRepository implements GenreRepositoryInterface {

  private Genre $genreModel;

  public function __construct(Genre $genreModel) {
    $this->genreModel = $genreModel;
  }

  public function getAll() {
    return $this->genreModel->orderBy('name', 'asc')->get();
  }
}
