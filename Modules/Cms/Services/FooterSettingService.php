<?php

namespace Modules\Cms\Services;

use Modules\Cms\Repositories\FooterSettingRepository;

class FooterSettingService
{


    protected $footerRepository;

    public function __construct(FooterSettingRepository $footerRepository)
    {
        $this->footerRepository = $footerRepository;
    }

    public function getAll()
    {
        return $this->footerRepository->getAll();
    }


    public function update($data, $id)
    {
        return $this->footerRepository->update($data, $id);
    }

    public function editById($id)
    {
        return $this->footerRepository->edit($id);
    }

}
