Trex.I.MenuFontTool = Trex.Mixin.create({
	oninitialized: function(config) {
        var self = this;
        self.beforeOnInitialized(config);
        var menuInitHandler = self.menuInitHandler && self.menuInitHandler.bind(self);
        self.weave(self.createButton(), self.createMenu(), self.handler, menuInitHandler);
        if (config.sync) {
            self.startSyncButtonWithStyle();
        }        
	},
    rangeExecutor: function(processor, newStyle, range) {
        this.wrapTextAsStyledSpan(processor, newStyle, range);
    },
    startSyncButtonWithStyle: function() {
        var self = this;
        self.canvas.observeJob(Trex.Ev.__CANVAS_PANEL_QUERY_STATUS, function(goog_range) {
            self.syncButton(self.queryCurrentStyle(goog_range));
        });
    },
    queryCurrentStyle: function(goog_range) {   // only for fontfamily, fontsize
        var self = this;
        var currentStyle = self.queryCommandValue();
        if (!currentStyle) {
            currentStyle = self.canvas.query(function(processor) {
                var targetNode;
                if ($tx.msie && goog_range.isCollapsed()) { // FTDUEDTR-1233
                    targetNode = processor.getNode();
                } else {
                    targetNode = self.findQueryingNode(goog_range);
                }
                return self.queryElementCurrentStyle(targetNode) || self.getDefaultProperty();
            });
        }
        return this.getTextByValue(currentStyle);
    },
    queryCommandValue: function() {
        var self = this;
        return self.canvas.query(function(processor) {
            var queriedValue = processor.queryCommandValue(self.getQueryCommandName());
            if (queriedValue && self.getTextByValue(queriedValue)) {
                return queriedValue;
            }
        });
    },
    queryElementCurrentStyle: function(element) {
        var cssPropertyName = this.getCssPropertyName();

        var queryingNode = element;
        var MAX_VISIT_PARENT = 10;
        for (var i = 0; i < MAX_VISIT_PARENT && $tom.kindOf(queryingNode, "%inline"); i++) {
            var currentStyleValue = queryingNode.style[cssPropertyName];
            if (currentStyleValue) {
                return currentStyleValue;
            }
            if ($tom.kindOf(queryingNode, 'font') && $tom.getAttribute(this.getFontTagAttribute())) {
                return $tom.getAttribute(this.getFontTagAttribute());
            }
            queryingNode = queryingNode.parentNode;
        }

        var processor = this.canvas.getProcessor();
        if (element) {
            return processor.queryStyle(element, cssPropertyName);
        } else {
            return _NULL;
        }
    },
    computeNewStyle: function(newStyle) {
        var style = {};
        style[this.getCssPropertyName()] = newStyle;
        return style;
    },

    cachedProperty: _FALSE,
    syncButton: function(text) {
        var self = this;
        self.button.setText(text);
        if (self.cachedProperty != text) {
            self.button.setText(text);
            self.cachedProperty = text;
        }
    }
});
