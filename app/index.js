'use strict';
var yeoman = require('yeoman-generator');
var chalk = require('chalk');


var foreach = function(obj, fn) {
  for (var prop in obj) {
    if (obj.hasOwnProperty(prop)) {
      fn(prop);
    }
  }
};
var modules = {
  Backend: true,
  Frontend: true,
  Database: false,
};

var WordpressPluginGenerator = yeoman.generators.Base.extend({
  init: function() {
    // this.pkg = require('../package.json');

    this.on('end', function() {

    });
  },


  askFor: function() {
    var done = this.async();
    var me = this;
    // have Yeoman greet the user
    // this.log(this.yeoman);

    // replace it with a short and sweet description of your generator
    this.log(chalk.magenta('You\'re using the wordpress-plugin generator.'));

    var prompts = [{
      type: 'input',
      name: 'namespace',
      message: 'In what namespace is your Plugin supposed to live?',
      default: 'naymspace'
    }, {
      type: 'input',
      name: 'name',
      message: 'How do you want to call your Plugin?',
      default: 'MyPlugin'
    }, {
      type: 'checkbox',
      name: 'modules',
      message: 'What modules do you want to include?',
      choices: []
    }];

    foreach(modules, function(module) {
      prompts[2].choices.push({ // beware of the index! //TODO
        name: module,
        value: 'include' + module,
        checked: modules[module]
      });
    });

    this.prompt(prompts, function(props) {
      foreach(modules, function(module) {
        me['include' + module] = props.modules.indexOf('include' + module) !== -1;
      });

      this.name = props.name;
      this.namespace = props.namespace;

      done();
    }.bind(this));
  },

  app: function() {
    var me = this;
    this.copy('index.php', 'index.php', this.applyNamespace.bind(this));
    this.directory('scripts', 'scripts', this.applyNamespace.bind(this));
    this.directory('stylesheets', 'stylesheets', this.applyNamespace.bind(this));
    this.directory('templates', 'templates', this.applyNamespace.bind(this));

    this.mkdir('modules');
    this.copy('modules/Helper.php', 'modules/Helper.php', this.applyNamespace.bind(this));
    foreach(modules, function(module) {
      if (me['include' + module]) {
        var path = 'modules/' + module + '.php';
        me.copy(path, path, me.applyNamespace.bind(me));
      }
    });
  },

  applyNamespace: function(str) {
    var namespace = this.namespace ? this.namespace + '\\' + this.name : this.name;
    return str ? str.replace(/<%namespace%>/g, namespace) : '';
  },

  projectfiles: function() {
    this.copy('editorconfig', '.editorconfig');
    this.copy('jshintrc', '.jshintrc');
    this.copy('README.md', 'README.md');
  }
});

module.exports = WordpressPluginGenerator;
