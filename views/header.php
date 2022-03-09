<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Coding Test</span>
    </a>
</header>
<h1>
	<?=$title?>
	<a href="/create-task" class="btn btn-primary <?= isset($showAddBtn) && !$showAddBtn ? "visually-hidden" :"";?>">Add</a>
</h1>
