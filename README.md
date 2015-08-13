## About

This is a simple key - value database with Write-ahead Log approach.

It supports 3 types of operation:
1. Write.
There must be only 1 write client at the moment.
It always writes to WAL log to improve performance.
To write some data, execute:
```
    php bin/write.php {key} {value}
```

1. Read.
There could be many read clients at the moment.
System is trying to find desired key in WAL file. If it was not found in WAL file - performs search in main storage.
To perform read operation, execute:
```
    php bin/read.php {key}
```

1. Checkpoint.
Saving data from WAL file into main storage. After this, WAL file is cleared.
To perform checkpoint, run:
```
    php bin/checkpoint.php
```
There isn't any automatic checkpoint.

## Installation

1. Build autoloader via composer:
```
    composer install
```

## Fill database with fake data

```
    php bin/write_batch.php
```
and there could be few concurrent batch readers:
```
    php bin/read_batch.php
```
