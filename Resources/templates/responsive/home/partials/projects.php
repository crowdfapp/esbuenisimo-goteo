<div class="section projects" >
    <div id="projects-container-title" class="container">
        <h2 class="title text-center">
            <?= $this->text('home-projects-title') ?>
        </h2>

        <?= $this->insertif('home/partials/projects_nav') ?>

    </div>
    <div class="container" id="projects-container">
        <?php if($this->projects): ?>
            <?= $this->insert('discover/partials/projects_list', [
                'projects' => $this->projects,
                'total' => $this->total_projects,
                'limit' => $this->limit,
                'filter' => $this->filter,
            ]) ?>
        <?php endif ?>
    </div>
</div>
