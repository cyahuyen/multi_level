<?php

class CI_Document {
    // Khai báo các biến
    private $title;
    private $description;
    private $keywords;
    private $links = array();
    private $styles = array();
    private $scripts = array();

    // Function này dùng để đặt tiêu đề cho trang chính là thẻ <title></title>
    public function setTitle($title) {
        $this->title = $title;
    }
    // Lấy thẻ title 
    public function getTitle() {
        return $this->title;
    }
    // ==================================================//
    // Ví dụ để sử dụng hàm trên để đặt tiêu đề cho site
    // Bước 1 : Load đến thư viện : $this->load->library('document');
    // Bước 2 : Đặt tiêu đề cho trang : $this->document->setTitle('Tiêu đề cho page');
    // Bước 3 : Lấy tiêu đề để đưa vào view :  $this->data['title'] = $this->document->getTitle();
    // ==================================================//
    
    // Dùng để đặt mô tả cho phần trang của bạn
    public function setDescription($description) {
        $this->description = $description;
    }
    // Lấy phần mô ta ra // Cách sử dụng các function dưới này đều tương tự như function đã giới thiệu ở trên
    public function getDescription() {
        return $this->description;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function addLink($href, $rel) {
        $this->links[md5($href)] = array(
            'href' => $href,
            'rel' => $rel
        );
    }

    public function getLinks() {
        return $this->links;
    }

    public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
        $this->styles[md5($href)] = array(
            'href' => $href,
            'rel' => $rel,
            'media' => $media
        );
    }

    public function getStyles() {
        return $this->styles;
    }

    public function addScript($script) {
        $this->scripts[md5($script)] = $script;
    }

    public function getScripts() {
        return $this->scripts;
    }

}

?>