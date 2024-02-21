<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="//unpkg.com/grapesjs/dist/css/grapes.min.css">
        <link rel="icon" type="image/svg" href="../../src/assets/logo/LogoFolioMaker.svg" />
        <title>Editor Template</title>
    </head>
    <style>
body {
    height: 100vh;
    margin: 0;
}
.app-wrap {
  width: 100%;
  display: flex;
  flex-direction: row;
}

#gjs {border: none;}
.gjs-one-bg {background-color: #12100E;}
.gjs-two-color {color: #F4F4F4;}
.gjs-three-bg {
    background-color: #ec5896;
    color: white;
}
.gjs-four-color,
.gjs-four-color-h:hover {
color: #256EFF;
}
.editor-wrap {
  flex: 1;
}
.pages-wrp {
  background: #f8f9fa;
  padding: 10px; 
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #212529;
}
.add-page {
  background: #007bff; 
  color: white;
  padding: 10px 20px; 
  border-radius: 5px; 
  cursor: pointer;
  margin-bottom: 10px;
}
.add-page:hover {
  background: #0056b3;
}
.page {
  background-color: #f8f9fa; 
  color: #212529; 
  padding: 10px; 
  margin-bottom: 10px; 
  border-radius: 5px; 
  cursor: pointer;
  transition: background-color 0.3s ease;
}
.page.selected {
  background-color: #007bff;
  color: white;
}
.page:hover {
  background-color: #e9ecef;
}
.page-close {
  opacity: 0.5;
  float: right;
  background-color: #007bff;
  color: white;
  height: 20px;
  width: 20px;
  line-height: 20px;
  text-align: center;
  border-radius: 50%;
  cursor: pointer;
  transition: opacity 0.3s ease;
}
.page-close:hover {
  opacity: 1;
}

</style>
    <body>
        <?php include $this->view;?>
        <script src="../../dist/js/main.js"></script>
    </body>
</html>
