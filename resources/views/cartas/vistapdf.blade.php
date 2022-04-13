<h5 class="card-title">De parte de tu patrocinador</h5>
<div class="card mb-1">
  <div class="p-1">
    <div class="header-elements">
      <div class="list-icons">
        <a class="list-icons-item" data-action="remove"></a>
      </div>
    </div>
    <div id="canvases"></div>
  </div>
</div>


<style type="text/css">

  #canvases canvas {
    width: 100%;
  }
</style>
<script>
      var arc='{{$buzonCarta->archivo}}';

      var url = '/storage/cartas/' + arc;

      var pdfjsLib = window['pdfjs-dist/build/pdf'];
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.worker.js';

      var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 1.5;

      function renderPage(num, canvas) {
      var ctx = canvas.getContext('2d');
      pageRendering = true;
      
      pdfDoc.getPage(num).then(function(page) {
        var viewport = page.getViewport({scale: scale});
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        var renderTask = page.render(renderContext);

        
        renderTask.promise.then(function() {
          pageRendering = false;
          if (pageNumPending !== null) {
            
            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });
      }

      pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
      pdfDoc = pdfDoc_;

      const pages = parseInt(pdfDoc.numPages);

      var canvasHtml = '';
      for (var i = 0; i < pages; i++) {
        canvasHtml += '<canvas id="canvas_' + i + '"></canvas>';
      }

      document.getElementById('canvases').innerHTML = canvasHtml;

      for (var i = 0; i < pages; i++) {
        var canvas = document.getElementById('canvas_' + i);
        renderPage(i+1, canvas);
      }
    });
</script>