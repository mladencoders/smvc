$(document).ready(function() {
    $("#generate").click(function() {
        Accgen.init($("#input").val());       
        $("#output").html(Accgen.getAccessors());
        
        if(Accgen.isParsed()) {
            $("#copy").removeAttr("disabled");
        }
    });
    
    $("#generate").click(function() {
        Accgen.init($("#input").val());       
        $("#output").html(Accgen.getAccessors());
        
        if(Accgen.isParsed()) {
            $("#copy").removeAttr("disabled");
        }
    });
    
    $("#input").on('paste', function () {
        if(Accgen.isParsed()) {
            $("#copy").attr("disabled", "disabled");
        }
    });
    
    $("#copy").click(function() {
        window.prompt("Copy to clipboard: Ctrl+C, Enter", Accgen.getAccessors());
    });
});

var Accgen = function() {
    var input;
    var output;
    var parsed;
    
    function parse()
    {
        input = input.split(";");
        $.each(input, function(key, value) {
            if (value === "") {
                return true; 
            }
            
            var variable = getVariableName(value);
            output += getGetter(variable);
            output += getSetter(variable);        
        });
        
        // trim leading and trailing spaces
        output = output.replace(/^\s+|\s+$/g,'');
        
        if (output !== "") {
            parsed = true;
        }    
    }
    
    function getVariableName(input) {
        var startIndex = input.indexOf('$') + 2;
        var endIndex = input.indexOf(' ', startIndex);

        if(endIndex === -1) {
            endIndex = input.length;
        }
        
        return input.substring(startIndex, endIndex);
    }
    
    function getSetter(variable) {
        return method = getSetterName(variable) + eol()
            + "{" + eol()
            + "    $this->_" + variable + " = $" + variable + ";" + eol()
            + "}" + eol() + eol();          
    }
    
    function getGetter(variable) {
        return method = getGetterName(variable) + eol()
            + "{" + eol()
            + "    return $this->_" + variable + ";" + eol()
            + "}" + eol() + eol();
    }
    
    function getSetterName(variable) {
        return 'public function set' + getMethodName(variable) + "($" + variable + ")";
    }
    
    function getGetterName(variable) {
        return 'public function get' + getMethodName(variable) + "()";
    }
    
    function getMethodName(variable) {
        return variable.charAt(0).toUpperCase() + variable.slice(1);
    }
    
    function eol() {
        return "\n";
    }
    
    return {
        init: function(rawInput) {
            input = rawInput;
            output = "";
            parsed = false;
        },
        isParsed: function() {
            return parsed;
        },
        getAccessors: function() {
            if (!this.isParsed()) {
                parse();
            }
            
            return output;
        }
    }
}();