<?php
namespace App\Components;

use Core\Classes\File;

class PostCard {
    private string $id;
    private string $title;
    private string $description;
    private string $link;
    private string $img;
    private string $createdAt;
    private string $updatedAt;
    private bool $isEditable;

    public function __construct(array $post, bool $isEditable = false) {
        $this->id = $post['id'] ?? '';
        $this->title = $post['title'] ?? '';
        $this->description = $post['description'] ?? '';
        $this->img = $post['img'] ?? '';
        $this->createdAt = $post['created_at'] ?? '';
        $this->updatedAt = $post['updated_at'] ?? '';
        $this->isEditable = $isEditable;
    }

    public function render(): void {
        $editButton = $this->isEditable ? "<a href='posts/update?id=$this->id' class='btn btn-sm btn-outline-secondary'>Редактировать</a>" : "";
        $img = (empty($this->img) || !File::exist(UPLOADS . "/" . $this->img)) ? "
            <svg width='100%' height='225' xmlns='http://www.w3.org/2000/svg' role='img' aria-label='Placeholder: No image' preserveAspectRatio='xMidYMid slice' focusable='false'>
                <title>Placeholder</title>
                <rect width='100%' height='100%' fill='#55595c'/>
                <text x='43%' y='50%' fill='#eceeef' dy='.3em'>No image</text>
            </svg>
        " :
        "
            <img src='uploads/$this->img' width='100%' height='225' class='post-card__img' alt='$this->title'/>
        ";

        echo "
            <div class='post-card card shadow-sm'>
                $img
                <div class='card-body'>
                    <p class='card-text'>$this->title</p>
                    <div class='d-flex justify-content-between align-items-center flex-wrap gap-2'>
                        <div class='btn-group'>
                            <a href='posts/?id=$this->id' class='btn btn-sm btn-outline-secondary'>Открыть</a>
                            $editButton
                        </div>
                        <small class='text-muted'>$this->updatedAt</small>
                    </div>
                </div>
            </div>
        ";
    }
}