scope.$watch(() => {
    return $(element).attr('kv-auto-numeric'); // set a watch on the actual DOM value
},
(val: string) => {
    opts = angular.extend({}, this.options, scope.$eval(val)) as AutoNumericOptions;

    // remove unneccessary zero numbers
    opts.aPad = false;
    element.autoNumeric('update', opts);
});