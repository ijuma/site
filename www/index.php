<?php require "includes/header.inc" ?>

<h3>Voldemort is a distributed key-value storage system</h3>
<ul>
  <li>Data is automatically replicated over multiple servers.</li>
  <li>Data is automatically partitioned so each server contains only a subset of the total data</li>
  <li>Server failure is handled transparently</li>
  <li>Pluggable serialization is supported to allow rich keys and values including lists and tuples with named fields, as well as to integrate
      with common serialization frameworks like Protocol Buffers, Thrift, and Java Serialization</li>
  <li>Data items are versioned to maximize data integrity in failure scenarios without compromising availability of the system</li>
  <li>Each node is independent of other nodes with no central point of failure or coordination</li>
  <li>Good single node performance: you can expect 10-20k operations per second depending on the machines, the network, and the replication factor</li>
  <li>Support for pluggable data placement strategies to support things like distribution across data centers that are geographical far apart.</li>
</ul>
<p>
It is used at LinkedIn for certain high-scalability storage problems where simple functional partitioning is not sufficient. It is still a new 
system which has rough edges, bad error messages, and probably plenty of uncaught bugs. Let us know if you find one of these, so we can fix it.
</p>
<h3>Comparison to relational databases</h3>
<p>
Voldemort is not a relational database, it does not attempt to satisfy arbitrary relations while satisfying ACID properties. 
Nor is it an object database that attempts
to transparently map object reference graphs. Nor does it introduce a new abstraction such as document-orientation. It is basically just a big,
distributed, persistent, fault-tolerant hash table. For applications that can use an O/R mapper like active-record or hibernate this will 
provide horizontal scalability and much higher availability but at great loss of convenience. For large applications 
under internet-type scalability pressure, a system may likely consists of a number of functionally partitioned services or apis, which
may manage storage resources across multiple data centers using storage systems which may themselves be horizontally partitioned. 
For applications in this space, 
arbitrary in-database joins are already impossible since all the data is not available in any single database. A typical pattern is to introduce
a caching layer which will require hashtable semantics anyway.  For these applications Voldemort offers a number of advantages:
</p>
<ul>
  <li>Voldemort combines in memory caching with the storage system so that a separete caching tier is not required (instead the storage system itself
      is just fast.</li>
  <li>Unlike MySQL replication, both reads and writes scale horizontally</li>
  <li>Data partioning is transparent, and allows for cluster expansion without rebalancing all data</li>
  <li>Data replication and placement is decided by a simple API to be able to accomadate a wide range of application specific strategies</li>
  <li>The storage layer is completely mockable so development and unit testing can be done against a throw-away in-memory storage system
      without needing a real cluster (or even a real storage system) for simple testing
  </li>
</ul>

<p>
The source code is available under the Apache 2.0 license. We are actively looking for contributors so if you have ideas, code, bug reports, or fixes
you would like to contribute please do so. 

<?php require "includes/footer.inc" ?>