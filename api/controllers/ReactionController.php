<?php

require_once '../models/Reaction.php';
class ReactionController
{
    // method to get all reactions for a post
    public function getReactions($post_id)
    {
        $reaction = new Reaction();
        $reactions = $reaction->getReactions($post_id);

        // return the reactions in JSON format
        return json_encode($reactions);
    }

    // method to create a reaction
    public function createReaction($post_id, $author_id, $type)
    {
        $reaction = new Reaction();
        $success = $reaction->createReaction($post_id, $author_id, $type);

        // verify if the reaction was created
        if ($success) {
            return json_encode(['message' => 'Reaction created']);
        } else {
            return json_encode(['error' => 'Failed to create reaction']);
        }
    }

    // method to delete a reaction
    public function deleteReaction($post_id, $author_id)
    {
        $reaction = new Reaction();
        $success = $reaction->deleteReaction($post_id, $author_id);

        if ($success) {
            return json_encode(['message' => 'Reaction deleted']);
        } else {
            return json_encode(['error' => 'Failed to delete reaction']);
        }
    }
}
