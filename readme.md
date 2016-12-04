#PHPDDDMD
PHPDDDMD is a ruleset for the [PHP Mess Detector (PHPMD)](https://github.com/phpmd/phpmd) 
that lets you detect invalid dependencies between the layers in a
[Domain Driven Design (DDD)](https://en.wikipedia.org/wiki/Domain-driven_design) 
architecture.

##Installation
    composer require lorenzschaef/phpdddmd --dev

##Usage
See the [PHPMD Manual](https://github.com/phpmd/phpmd#command-line-usage) 
for general usage instructions. To use the DDD rules, include
the **rulesets/dddrules.xml** file in your own ruleset definition.

```xml
<?xml version="1.0"?>
<ruleset name="My first PHPMD rule set"
         xmlns="http://pmd.sf.net/ruleset/1.0.0"
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://pmd.sf.net/ruleset/1.0.0
                     http://pmd.sf.net/ruleset_xml_schema.xsd"
         xsi:noNamespaceSchemaLocation="
                     http://pmd.sf.net/ruleset_xml_schema.xsd">
    <description>
        My custom rule set that checks my code...
    </description>

    <!-- Import the DDD rule set -->
    <rule ref="vendor/lorenzschaef/phpdddmd/rulesets/dddrules.xml" />
</ruleset>
```

##Rules
This ruleset contains two new rules for PHPMD.

###No Outward Dependencies
This rule detects dependencies to layers outside of the current
one. For example, a class in the Domain layer using a class from 
the Application or Infrastructure layers would be a violation 
of this rule.

###No Layer Skipping
This rule detects dependencies to a layer that is inside the
current one, but not immediately adjacent. A class located in 
the Infrastructure layer (e.g. a controller) communicating with
the Domain layer directly, skipping the Application layer, would
be a violation of this rule.

**There is an important exception to this rule:** Classes that
implement an interface from another layer may directly interact
with that layer. For example, a class *MysqlUserRepository* 
(Infrastructure) that implements an interface *UserRepository* 
(Domain) may directly work with Domain objects.

##Customizing the Layer Names
Both rules accept a property parameter called "layers". If you 
include the whole ruleset, they are automatically set to the three
standard DDD layers: 
- Domain
- Application
- Infrastructure

You can change the list of layers by creating your own ruleset
and specifying your own list of layers. Take a look at the original
ruleset for reference. 
The list must start with the innermost layer and the names are
case sensitive.