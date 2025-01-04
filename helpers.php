<?php

/**
 * Database Helper Functions
 */
//TODO why isn't this in the NutribaseRepository class?
function doQuery(string $sql, array $params, mysqli $conn): array {
    // Prepare the query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    try {
        // Bind parameters if provided
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assume all parameters are strings for simplicity
            $stmt->bind_param($types, ...$params);
        }

        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Execution error: " . $stmt->error);
        }

        // Fetch results if the query returns any
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    } finally {
        $stmt->close();
    }
}

/**
 * HTML Helper Functions
 */
//TODO why isn't this in the NutribaseView class?
function bootstrapWrap(string $content): string {
    $bootstrapUrl = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css";

    $customBackground = 
    "<style>" .
        ".custom-blue-bg {" .
            "background-color: #17a2b8;" .
        "}" .
    "</style>";

    $preContent = "<!DOCTYPE html>" .
        "<html lang=\"en\">" .
        "<!-- Version 1 -->" .
        "<head>" .
        "<meta charset=\"UTF-8\">" .
        "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">" .
        "<title>Nutribase</title>" .
        "<link href=\"" . $bootstrapUrl . "\" rel=\"stylesheet\">" .
        $customBackground .
        "</head><body>";
    $postContent = "</body></html>";

    return $preContent . $content . $postContent;
}

/**
 * Response Helper Functions
 */
function sendResponse($content, string $contentType = 'application/json', int $httpStatus = 200): never {

    // Set HTTP response code and content type
    http_response_code($httpStatus);
    header("Content-Type: $contentType");
    
    // Ensure we handle different content types appropriately
    if (is_array($content) && $contentType === 'application/json') {
        // Handle array content (e.g., JSON response)
        echo json_encode($content);
    } elseif (is_string($content) && $contentType === 'text/html') {
        // Handle string content (e.g., HTML response)
        echo $content;
    } else {
        // Handle any other types or defaults
        echo $content; // Default output if no specific type is found
    }


    // Terminate script
    exit;
}

 