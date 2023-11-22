<h1>Import your data</h1>

<div class="row">
    <form method="post" enctype="multipart/form-data" class="dashboard-map">
        <div class="d-flex col-md-12">
            <input class="form-control" type="file" name="jsonFile" required uniq accept="application/JSON">
            <button class="btn btn-secondary" type="submit">Upload</button>
            <input type="hidden" name="action" value="loadJsonFile">
        </div>
    </form>
</div>