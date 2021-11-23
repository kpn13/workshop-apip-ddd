# Workshop DDD x API Platform

This is a demo project used for the DDD x API Platform Workshop by @chalasr & @mtarld from @coopTilleuls.

## Checkout

```sh
git clone git@github.com:coopTilleuls/workshop-apip-ddd
```

## Setup

```sh
make start
```

## 1) Modelling the Domain

```sh
git checkout step1-domain
```

You've got:

- An `api-platform` with Hexagonal Architecture.
- Two Bounded Contexts: `Book` and `Stock` with Aggregates (Entites & VOs)

## 2) Defining the Application' Use Cases

```sh
git checkout step2-application
```

You've got:
- CRUD-like Commands, Queries, Handlers, Repository interfaces and Domain exceptions allowing to interact with `Book` context.

## 3) Wire everything to make things works

```sh
git checkout step3-infrastructure
make db-reset
```

Now the Application use cases are exposed through an API using `api-platform`, Commands & Queries get handled thanks to `symfony/messenger`, and data are persisted thanks to `doctrine`.

## 4) Exercise

```sh
git checkout step4-exercise
```

You have got a test case covering a new use case allowing to borrow a Book from the Stock.
The test case is skipped for now - Your turn, make it pass! :)

## 5) Finish

An example implementation for the exercise is added on this branch.
Please don't cheat, you shouldn't check this out until you did try to do it on step 4) :)
=======
# Workshop API/DDD
