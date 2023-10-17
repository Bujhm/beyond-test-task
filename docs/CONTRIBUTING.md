### "Make" comand
Use **_Make_** command without arguments to see help with possible console commands

---

### Doctrine migrations
_Pay attention_ to FQN path to the migration (usually DoctrineMigrations\\<Your_migration>)

**On/Off migration** _(for testing purpose or usr --dry [w/oreal changes to the db], example):_
```shell
$php bin/console doctrine:migrations:exec DoctrineMigrations\\Version20231016084720 --up
```