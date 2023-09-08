<?php

namespace Modules\Cms\Repositories;

use Modules\Cms\Entities\FooterWidget;
use Modules\Cms\Entities\FrontPage;

class FooterWidgetRepository
{

    protected $widget;
    protected $staticPage;

    public function __construct(FooterWidget $widget, FrontPage $staticPage)
    {
        $this->widget = $widget;
        $this->staticPage = $staticPage;
    }


   
    
    public function getAll()
    {
        return $this->staticPage::where('is_static', 1)->get();
    }

    public function getAllCompany()
    {
        return $this->widget::where('section', '1')->orderBy('id', 'ASC')->get();
    }

    public function getAllAccount()
    {
        return $this->widget::where('section', '2')->orderBy('id', 'ASC')->get();
    }

    public function getAllService()
    {
        return $this->widget::where('section', '3')->orderBy('id', 'ASC')->get();
    }

    public function getAllAbout()
    {
        return $this->widget::where('section', '4')->orderBy('id', 'ASC')->get();
    }


    public function save($data)
    {
//       dd($data);
        $widget = $this->widget::create([
           'name' =>$data['name'],
            'slug' => $data['page'] ?? '',
            'category' => $data['category'] ?? '',
            'section' => $data['category'] ?? '',
            'page' => $data['page'] ?? '',
            'page_id' => $data['page_id'] ?? 0,
            'status' => 1,
            'is_static' => $data['is_static'] ?? 0
        ]);

//        foreach ($data['name'] as $key => $name) {
//            $widget->setTranslation('name', $key, $name);
//        }
        $widget->save();
        return $widget;
    }

    public function update($data, $id)
    {

        $widget = $this->widget::where('id', $id)->first();

        $this->widget::where('id', $id)->update([
           'name'=>$data['name'],
            'slug' => $data['slug'] ?? '',
            'category' => $data['category'] ?? '',
            'section' => $data['category'] ?? '',
            'page' => $data['page'] ?? '',
            'page_id' => $data['page_id'] ?? 0,
            'description' => $data['description'] ?? '',
            'is_static' => $data['is_static'] ?? 0
        ]);
//        foreach ($data['name'] as $key => $name) {
//            $widget->setTranslation('name', $key, $name);
//        }
        $widget->save();
        return $widget;
    }

    public function edit($id)
    {
        $widget = $this->widget->findOrFail($id);
        return $widget;
    }

    public function statusUpdate($data, $id)
    {
        $row = $this->widget::where('id', $id)->first();
        $row->status = $row->status == 1 ? 0 : 1;
        $row->save();
    }

    public function delete($id)
    {
        return $this->widget->findOrFail($id)->delete();
    }
}
