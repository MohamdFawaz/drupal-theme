
jQuery(document).ready(function ($) {
    // $(function  () {
    //   $("ol.example").sortable();
    // });
  var group = $("ol.example").sortable({
    group: 'limited_drop_targets',
    isValidTarget: function  ($item, container) {
      if($item.is(".highlight"))
        return true;
      else
        return $item.parent("ol")[0] == container.el[0];
    },
    onDrop: function ($item, container, _super) {
      $('#serialize_output').text(
          group.sortable("serialize").get().join("\n"));
      _super($item, container);
    },
    serialize: function (parent, children, isContainer) {
      var container = isContainer ? children.join() : parent.text();
      console.table(children.join());
        return container;
      },
    tolerance: 6,
    distance: 10
  });
});