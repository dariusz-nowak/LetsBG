<?php

declare(strict_types=1);

namespace App\Repository\Producers;

use App\Models\Producer;
use App\Repository\ProducersRepository as ProducersRepositoryInterface;

class ProducersRepository implements ProducersRepositoryInterface {

  private Producer $producerModel;

  public function __construct(Producer $producerModel) {
    $this->producerModel = $producerModel;
  }

  public function getAll() {
    return $this->producerModel->get();
  }
}
