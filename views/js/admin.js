$(document).ready(function () {
  window.prestashop.component.initComponents([
    "ChoiceTree",
    "TranslatableInput",
  ]);

  new window.prestashop.component.ChoiceTree(".js-choice-tree-container");
});
