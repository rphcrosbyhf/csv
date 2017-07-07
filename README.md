# CSV Parsing Library

Simple library for dealing with CSVs. Has the following features:

- Parsing
- Validating
- Normalizing
- Persisting

# Parsing

```php
$csv = new CsvFile(new \SplFileObject('path/to/file.csv'));

foreach ($csv->rows() as $row) {
    // Do something with the row
}
```

# Validation

Validation can be done using schema files:

```yaml
fields:
  - name: first_name
    rules:
      maxLength: 25
      minLength: 5
  - name: last_name
    rules:
      maxLength: 25
      minLength: 5
  - name: email
    rules:
      type: email
```

```php
$schema = new YamlSchema(
    new \SplFileObject('path/to/schema.yaml'),
    new Parser()
);

$csv = new ValidatedCsvFile(
    new CsvFile(new \SplFileObject('path/to/file.csv')),
    $schema->rules()
);
```

# Persisting

```php
$csv = new PgCopyPersistableFile(
    new CsvFile(new \SplFileObject('path/to/file.csv')),
    'localhost',
    'mydb',
    'root',
    'password',
    'users'
);

$csv->persist();
```