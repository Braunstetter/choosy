import { Application } from "@hotwired/stimulus"
import choosy_controller from "@braunstetter/choosy-type/controllers/choosy_controller"

window.Stimulus = Application.start()
Stimulus.debug = true;
Stimulus.warnings = true;
Stimulus.register('braunstetter--choosy-type--choosy', choosy_controller)