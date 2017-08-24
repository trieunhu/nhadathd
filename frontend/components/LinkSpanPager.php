<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\components;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Description of LinkSpanPager
 *
 * @author trieunhu
 */
class LinkSpanPager extends \yii\widgets\LinkPager{
    public $slug;
    public $action;
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }

        return implode("\n", $buttons);
    }
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);

            return Html::tag('li', Html::tag('span', $label), $options);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;
//        return 'a';
        return Html::tag('span', Html::a($label, $this->createUrl($page), $linkOptions), $options);
    }
    public function createUrl($page, $pageSize = null, $absolute = false)
    {
        $page = (int) $page + 1;
        if ($page == 1) {
            return Url::to([$this->action,'slug'=>  $this->slug]);
        } 
        return Url::to([$this->action,'slug'=>  $this->slug,'page'=>$page]);
    }
}
