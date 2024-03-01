<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "samuel",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "andrey"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("andrey");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "samuel"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "samuel"
        ])->post("/todolist", [
            "todo" => "andrey"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "samuel",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "andrey"
                ],
                [
                    "id" => "2",
                    "todo" => "prasetya"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
