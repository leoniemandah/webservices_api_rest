window.onload = function() {
  //<editor-fold desc="Changeable Configuration Block">


        const ui = SwaggerUIBundle({
        url: window.location.protocol + "//" + window.location.hostname + "/dist/spec.yml",
        dom_id: '#swagger-ui',
        deepLinking: true,
          presets: [
              SwaggerUIBundle.presets.apis,
              SwaggerUIStandalonePreset
          ],
          layout: "StandaloneLayout"
      })
  // the following lines will be replaced by docker/configurator, when it runs in a docker-container
  window.ui = ui;

  //</editor-fold>
};
