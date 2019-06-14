<?php
    $id=$_GET["id"];
    $target_dir = "/projetofinal/uploads/";
    $target_file = $target_dir . $id;
?>


<div id="pdf" class=" pdfobject-container">
<embed class="pdfobject" src="<?php echo $target_file ?>" style="overflow: auto; width: 100%; height: 100%;" internalinstanceid="15">
</div>

