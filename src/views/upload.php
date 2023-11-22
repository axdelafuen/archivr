<title>Panorama Generator</title>

<div class="mt-5">

    <h1 class="text-center font-weight-bold mb-5">Load your image</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="d-flex justify-content-center">
            <div class="text-center col-2">
                <p class="font-weight-bold">Your project's name</p>
                <input class="mb-5 form-control" type="text" placeholder="My amazing panorama" name="projectName" required/>
            </div>
        </div>

        <div class="d-flex justify-content-around">
            <div class="row mb-5 mt-5 ">
                <div class="text-center col">
                    <p class="font-weight-bold">Load your 360 images</p>
                    <input class="form-control" type="file" name="views[]" required multiple accept="image/*">
                </div>
                <div class="text-center col">
                    <p class="font-weight-bold">Load your map</p>
                    <input class="form-control" type="file" name="map" accept="image/*">
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary text-center mt-5">Continue <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                </svg>
            </button>
            <input type="hidden" name="action" value="viewsUploaded">
        </div>
    </form>
</div>
