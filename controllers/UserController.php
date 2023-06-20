<?php

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function index() {
        $result = $this->user->getAllUsers();

        if ($result->num_rows > 0) {
            $users_arr = array();
            $users_arr['data'] = array();

            while ($row = $result->fetch_assoc()) {
                extract($row);

                $user_item = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email
                );

                array_push($users_arr['data'], $user_item);
            }

            echo json_encode($users_arr);
        } else {
            echo json_encode(array('message' => 'No users found.'));
        }
    }

    public function show($id) {
        $result = $this->user->getUserById($id);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            extract($row);

            $user_item = array(
                'id' => $id,
                'name' => $name,
                'email' => $email
            );

            echo json_encode($user_item);
        } else {
            echo json_encode(array('message' => 'User not found.'));
        }
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->email)) {
            if ($this->user->createUser($data->name, $data->email)) {
                echo json_encode(array('message' => 'User created successfully.'));
            } else {
                echo json_encode(array('message' => 'User creation failed.'));
            }
        } else {
            echo json_encode(array('message' => 'Name and email are required.'));
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->email) && !empty($data->id)) {
            if ($this->user->updateUser($data->name, $data->email, $data->id)) {
                echo json_encode(array('message' => 'User update successfully.'));
            } else {
                echo json_encode(array('message' => 'User update failed.'));
            }
        } else {
            echo json_encode(array('message' => 'Name and email are required.'));
        }
    }
}
