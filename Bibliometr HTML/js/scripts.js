function panelToggle() {
    var panel = document.getElementById("panel");
    if (panel.style.display == "flex") {
        panel.style.display = "none";
    } else {
      panel.style.display = "flex";
    }
  }
  function panelToggleE() {
    var panel = document.getElementById("panel_edycja");
    if (panel.style.display == "flex") {
        panel.style.display = "none";
    } else {
      panel.style.display = "flex";
    }
  }
  function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
  $(document).ready(function(){
    $("#szukaj").click(function(){
        $("#searchbars").slideToggle("fast");
    });
});